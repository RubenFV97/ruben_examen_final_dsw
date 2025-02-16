<?php

namespace App\Livewire\Admin;

use App\Models\Transition;
use App\Models\Instruction;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DesaButton;

class InstructionTransitions extends Component
{
    use WithPagination;
    
    public $scenario;
    public $transitions;
    public $showModal = false;
    public $editingTransition = null;
    public $search = '';
    public $sortField = 'fromInstruction.title';
    public $sortDirection = 'asc';
    public $availableDesaButtons = [];
    public $isInitial = false;
    
    
    
    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc']
    ];
    
    // Form fields
    public $fromInstructionId;
    public $toInstructionId;
    public $trigger = '';
    public $timeSeconds = null;
    public $desaButtonId = null;
    public $loopCount = null;
    
    protected $rules = [
        'fromInstructionId' => 'required|exists:instructions,id',
        'toInstructionId' => 'required|exists:instructions,id',
        'trigger' => 'required|in:time,user_choice,loop',
        'timeSeconds' => 'required_if:trigger,time|nullable|integer|min:1',
        'desaButtonId' => 'required_if:trigger,user_choice|nullable|exists:desa_buttons,id',
        'loopCount' => 'required_if:trigger,loop|nullable|integer|min:1',
        'isInitial' => 'boolean'
    ];
    
    protected $messages = [
        'fromInstructionId.required' => 'La instrucción de origen es obligatoria.',
        'fromInstructionId.exists' => 'La instrucción de origen seleccionada no es válida.',
        'toInstructionId.required' => 'La instrucción de destino es obligatoria.',
        'toInstructionId.exists' => 'La instrucción de destino seleccionada no es válida.',
        'trigger.required' => 'El disparador es obligatorio.',
        'trigger.in' => 'El disparador debe ser uno de los valores permitidos: tiempo, elección del usuario o bucle.',
        'timeSeconds.required_if' => 'El tiempo en segundos es obligatorio cuando el disparador es "tiempo".',
        'timeSeconds.integer' => 'El tiempo en segundos debe ser un número entero.',
        'timeSeconds.min' => 'El tiempo en segundos debe ser al menos 1.',
        'desaButtonId.required_if' => 'El botón del DESA es obligatorio cuando el disparador es "elección del usuario".',
        'desaButtonId.exists' => 'El botón del DESA seleccionado no es válido.',
        'loopCount.required_if' => 'El número de bucles es obligatorio cuando el disparador es "bucle".',
        'loopCount.integer' => 'El número de bucles debe ser un número entero.',
        'loopCount.min' => 'El número de bucles debe ser al menos 1.',
    ];
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->loadTransitions();
    }
    
    public function updatedSearch()
    {
        $this->loadTransitions();
    }
    
    
    public function updatedTrigger()
    {
        $this->timeSeconds = null;
        $this->desaButtonId = null;
        $this->loopCount = null;
    }
    
    public function mount($scenario)
    {
        $this->scenario = $scenario;
        $this->loadTransitions();
        $this->loadDesaButtons();
    }
    
    private function loadDesaButtons()
    {
        if ($this->scenario->desaTrainer->id) {
            $this->availableDesaButtons = DesaButton::where('desa_trainer_id', $this->scenario->desaTrainer->id)->get();
        }
    }

    
    public function loadTransitions()
    {
        // Cargar todas las transiciones del escenario
        $allTransitions = Transition::with(['fromInstruction', 'toInstruction'])
        ->whereHas('fromInstruction', function($q) {
            $q->where('scenario_id', $this->scenario->id);
        })
        ->when($this->search, function($query) {
            $query->whereHas('fromInstruction', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('toInstruction', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->orderBy('is_initial', 'desc')
        ->orderByRaw('CAST((SELECT name FROM instructions WHERE instructions.id = transitions.from_instruction_id) AS UNSIGNED)')
        ->get();
        
        $initialTransition = $allTransitions->where('is_initial', true)->first();
        
        if ($initialTransition) {
            $processedTransitions = collect();
            
            // Función recursiva para marcar las transiciones en el flujo
            $markTransitionsInFlow = function($currentInstructionId) use (&$markTransitionsInFlow, &$processedTransitions, $allTransitions) {
                $nextTransitions = $allTransitions
                ->where('from_instruction_id', $currentInstructionId)
                ->whereNotIn('id', $processedTransitions->pluck('id'));
                
                foreach ($nextTransitions as $transition) {
                    $processedTransitions->push($transition);
                    $markTransitionsInFlow($transition->to_instruction_id);
                }
            };
            
            $processedTransitions->push($initialTransition);
            $markTransitionsInFlow($initialTransition->to_instruction_id);
            
            $allTransitions = $allTransitions->map(function($transition) use ($processedTransitions) {
                $transition->is_in_flow = $processedTransitions->contains('id', $transition->id);
                return $transition;
            });
        } else {
            $allTransitions = $allTransitions->map(function($transition) {
                $transition->is_in_flow = true;
                return $transition;
            });
        }

        $this->transitions = $allTransitions;
    }
    
    
    public function createTransition()
    {
        $this->resetForm();
        $this->showModal = true;
    }
    
    public function editTransition(Transition $transition)
    {
        $this->editingTransition = $transition;
        $this->fromInstructionId = $transition->from_instruction_id;
        $this->toInstructionId = $transition->to_instruction_id;
        $this->trigger = $transition->trigger;
        $this->timeSeconds = $transition->time_seconds;
        $this->desaButtonId = $transition->desa_button_id;
        $this->loopCount = $transition->loop_count;
        $this->isInitial = $transition->is_initial;
        $this->showModal = true;
    }
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'from_instruction_id' => $this->fromInstructionId,
            'to_instruction_id' => $this->toInstructionId,
            'trigger' => $this->trigger,
            'is_initial' => $this->isInitial
        ];

        if ($this->isInitial) {
            Transition::whereHas('fromInstruction', function($query) {
                $query->where('scenario_id', $this->scenario->id);
            })->update(['is_initial' => false]);
        }
        
        switch ($this->trigger) {
            case 'time':
                $data['time_seconds'] = $this->timeSeconds;
                break;
                case 'user_choice':
                    $data['desa_button_id'] = $this->desaButtonId;
                    break;
                    case 'loop':
                        $data['loop_count'] = $this->loopCount;
                        break;
                    }
                    
                    if ($this->editingTransition) {
                        $this->editingTransition->update($data);
                        $this->dispatch('swal:success', [
                            'title' => '¡Éxito!',
                            'text' => 'La transición se ha actualizado correctamente',
                        ]);
                    } else {
                        Transition::create($data);
                        $this->dispatch('swal:success', [
                            'title' => '¡Éxito!',
                            'text' => 'La transición se ha creado correctamente',
                        ]);
                    }
                    
                    $this->showModal = false;
                    $this->loadTransitions();
                    $this->resetForm();
                }
                
                public function deleteTransition(Transition $transition)
                {
                    $this->dispatch('transition:confirm', [
                        'title' => '¿Estás seguro?',
                        'text' => '¡No podrás revertir esto!',
                        'id' => $transition->id
                    ]);
                }
                
                public function confirmedDelete($id)
                {
                    $transition = Transition::find($id);
                    $transition->delete();
                    $this->loadTransitions();
                    
                    $this->dispatch('swal:success', [
                        'title' => '¡Eliminado!',
                        'text' => 'La transición ha sido eliminada.'
                    ]);
                }
                
                private function resetForm()
                {
                    $this->editingTransition = null;
                    $this->fromInstructionId = '';
                    $this->toInstructionId = '';
                    $this->trigger = '';
                    $this->timeSeconds = null;
                    $this->desaButtonId = null;
                    $this->loopCount = null;
                    $this->isInitial = false;
                    $this->resetValidation(); 
                }
                
                public function render()
                {
                    return view('livewire.admin.instruction-transitions', [
                        'availableInstructions' => $this->scenario->instructions,
                        'modalId' => 'transitionModal',
                        'availableDesaButtons' => $this->availableDesaButtons,

                    ]);
                }


                public function closeModal()
                {
                    $this->showModal = false;
                    $this->resetForm();
                    $this->loadTransitions();
                }
            }