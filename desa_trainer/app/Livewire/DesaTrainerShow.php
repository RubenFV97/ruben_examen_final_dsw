<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\DesaTrainer;
use App\Models\DesaButton;

class DesaTrainerShow extends Component
{
    public $desaTrainer;
    public $showButtonForm = false;
    public $buttonLabel = '';
    public $buttonArea = [];
    public $buttonColor = '#007bff';
    public $isBlinking = false;
    public $editingButton = null;

    protected $listeners = ['areaSelected'];

    protected $rules = [
        'buttonLabel' => 'required|string|max:255',
        'buttonArea' => 'required|array|min:3',
        'buttonColor' => 'required|string|regex:/^#[a-fA-F0-9]{6}$/',
        'isBlinking' => 'boolean'
    ];

    protected $messages = [
        'buttonLabel.required' => 'La etiqueta del botón es obligatoria.',
        'buttonLabel.max' => 'La etiqueta no puede tener más de 255 caracteres.',
        'buttonArea.required' => 'Debe dibujar un área para el botón.',
        'buttonArea.min' => 'El área debe tener al menos 3 puntos.',
        'buttonColor.required' => 'Debe seleccionar un color.',
        'buttonColor.regex' => 'El color debe ser un valor hexadecimal válido.',
    ];

    public function mount(DesaTrainer $desaTrainer)
    {
        $this->desaTrainer = $desaTrainer;
    }

    public function startNewButton()
    {
        $this->reset(['buttonLabel', 'buttonArea', 'editingButton']);
        $this->buttonColor = '#007bff';
        $this->isBlinking = false;
        $this->showButtonForm = true;
        $this->dispatch('startDrawing');
    }

    public function areaSelected($points)
    {
        $this->buttonArea = $points;
    }

    public function saveButton()
    {
        $this->validate();

        try {
            if ($this->editingButton) {
                $button = DesaButton::find($this->editingButton);
                $button->update([
                    'label' => $this->buttonLabel,
                    'area' => $this->buttonArea,
                    'color' => $this->buttonColor,
                    'is_blinking' => $this->isBlinking
                ]);
                session()->flash('success', 'Botón editado correctamente.');
            } else {
                DesaButton::create([
                    'desa_trainer_id' => $this->desaTrainer->id,
                    'label' => $this->buttonLabel,
                    'cordinate' => json_encode($this->buttonArea),
                    'color' => $this->buttonColor,
                    'is_blinking' => $this->isBlinking
                ]);
                session()->flash('success', 'Botón creado correctamente.');
            }

            $this->reset(['showButtonForm', 'buttonLabel', 'buttonArea', 'editingButton', 'buttonColor', 'isBlinking']);
            $this->dispatch('resetCanvas');

            $this->desaTrainer->refresh();
            $this->dispatch('buttonSaved', ['buttons' => $this->desaTrainer->buttons]);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al guardar el botón.');
        }
    }

    public function editButton($buttonId)
    {
        $button = DesaButton::findOrFail($buttonId);

        $this->editingButton = $buttonId;
        $this->buttonLabel = $button->label;
        $this->buttonArea = $button->area;
        $this->buttonColor = $button->color;
        $this->isBlinking = $button->is_blinking;
        $this->showButtonForm = true;

        $this->dispatch('loadArea', [
            'area' => $button->area,
            'buttonId' => $buttonId,
            'color' => $button->color,
            'isBlinking' => $button->is_blinking,
            'editable' => true
        ]);
    }

    public function deleteButton($buttonId)
    {
        try {
            $button = DesaButton::findOrFail($buttonId);
            $button->delete();

            $this->desaTrainer->refresh();
            $this->dispatch('buttonDeleted', ['buttons' => $this->desaTrainer->buttons]);
            session()->flash('success', 'Botón eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar el botón.');
        }
    }

    public function cancelButton()
    {
        $this->reset(['showButtonForm', 'buttonLabel', 'buttonArea', 'editingButton', 'buttonColor', 'isBlinking']);
        $this->dispatch('resetCanvas');
    }

    public function render()
    {
        return view('livewire.desa-trainer-show');
    }
}
