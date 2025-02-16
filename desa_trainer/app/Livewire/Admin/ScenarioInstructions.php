<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ScenarioInstructions extends Component
{
    use WithFileUploads;
    
    public $scenario;
    public $instructions;
    public $showModal = false;
    public $isEditing = false;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $search = '';

    
    // Form fields
    public $name = '';
    public $description = '';
    public $audio_file;
    public $editingInstructionId = null;
    public $removeAudio = false;

    protected $queryString = [
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    public function updatedSearch()
    {
        $this->loadInstructions();
    }

    
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'audio_file' => 'nullable|file|mimes:mp3,wav|max:10240',
    ];
    
    // Mensajes personalizados
    protected $messages = [
        'name.required' => 'El campo título es obligatorio.',
        'name.min' => 'El título debe tener al menos 3 caracteres.',
        'description.required' => 'El campo description es obligatorio.',
        'audio_file.mimes' => 'El archivo de audio debe ser de tipo mp3 o wav.',
        'audio_file.max' => 'El archivo de audio no debe exceder los 10MB.',
    ];

    public function mount($scenario)
    {
        $this->scenario = $scenario;
        $this->loadInstructions();
    }
    
    public function loadInstructions()
    {
        $this->instructions = $this->scenario->instructions()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortField === 'name', function ($query) {
                $query->orderByRaw('CAST(name AS UNSIGNED) ' . $this->sortDirection);
            }, function ($query) {
                $query->orderBy($this->sortField, $this->sortDirection);
            })
            ->get();
        $this->dispatch('reloadTable');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->loadInstructions();
    }
    
    public function createInstruction()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEditing = false;
        $this->dispatch('show-modal');
    }
    
    public function editInstruction($instructionId)
    {
        $instruction = Instruction::find($instructionId);
        $this->editingInstructionId = $instructionId;
        $this->name = $instruction->name;
        $this->description = $instruction->description;
        $this->showModal = true;
        $this->isEditing = true;
        
        $this->dispatch('startEditing');
    }
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'name' => $this->name,
            'description' => $this->description,
        ];
        
        if ($this->isEditing) {
            $instruction = Instruction::find($this->editingInstructionId);
            
            if ($this->removeAudio && $instruction->audio_file) {
                Storage::disk('public')->delete($instruction->audio_file);
                $data['audio_file'] = null;
            } elseif ($this->audio_file) {
                if ($instruction->audio_file) {
                    Storage::disk('public')->delete($instruction->audio_file);
                }
                $path = $this->audio_file->store('instructions/audio', 'public');
                $data['audio_file'] = $path;
            }
            
            $instruction->update($data);
            $message = 'Instrucción actualizada exitosamente.';
        } else {
            $data['scenario_id'] = $this->scenario->id;
            
            if ($this->audio_file) {
                $path = $this->audio_file->store('instructions/audio', 'public');
                $data['audio_file'] = $path;
            }
            
            Instruction::create($data);
            $message = 'Instrucción creada exitosamente.';
            
        }
        
        $this->closeModal();
        $this->loadInstructions();
        
        $this->dispatch('swal:success', [
            'name' => '¡Éxito!',
            'text' => $message,
        ]);
    }
    
    public function deleteInstruction($instructionId)
    {
        $this->dispatch('instructions:confirm', [
            'name' => '¿Estás seguro?',
            'text' => '¡Esta instrucción será eliminada permanentemente!',
            'id' => $instructionId
        ]);
    }
    
    public function confirmedDelete($id)
    {
        $instruction = Instruction::find($id);
        
        if ($instruction->audio_file) {
            Storage::disk('public')->delete($instruction->audio_file);
        }
        
        $instruction->delete();
        $this->loadInstructions();
        $this->dispatch('swal:success', [
            'name' => '¡Eliminado!',
            'text' => 'La instrucción ha sido eliminada exitosamente'
        ]);
        
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('endEditing');
    }
    
    private function resetForm()
    {
        $this->reset(['name', 'description', 'audio_file', 'editingInstructionId', 'removeAudio']);
        $this->resetValidation(); // Añade esta línea para limpiar los errores de validación
    }
    
    public function render()
    {
        return view('livewire.admin.scenario-instructions', [
            'modalId' => 'instructionsModal'
        ]);
    }
}