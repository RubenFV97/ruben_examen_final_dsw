<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Scenario;
use App\Models\DesaTrainer;
class Examencomponent extends Component
{
    public function render()
    {
        return view('livewire.examencomponent');
    }

    public function show(string $id)
    {
        $scenario = Scenario::findOrFail($id);
        $desatrainer = DesaTrainer::findOrFail($scenario->desatrainer_id);


        return view("admin.scenarios.show-scenario", compact("scenario", "desatrainer"));
    }

    public function siguiente(string $id)
    {
        $id++;
    }

    public function volver(string $id)
    {
        $id--;
    }
}
