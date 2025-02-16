<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Models\Scenario;
use Illuminate\Http\Request;
use App\Http\Requests\InstructionsRequest;
use App\Models\DesaButton;

class InstructionsController extends Controller
{
    public function show( Request $request, $id)
    {
        $instructions = Instruction::findOrFail($id);
      

        return view('admin.instructions.show', compact('instructions'));
    }

    public function destroy(Request $request, $id)
    {
        $instruction = Instruction::findOrFail($id);
        $instruction->delete();

        return redirect()->route('scenarios.show', $instruction->scenario_id)
                         ->with('success', 'La Instrucción fue eliminada correctamente.');
    }
    
    public function create(Scenario $scenario)
    {
        // Obtener todos los botones disponibles
        $desaButtons = DesaButton::all();
        
        return view('admin.instructions.create', compact('scenario', 'desaButtons'));
    }


   public function store(InstructionsRequest $request, $id)
{
    // Buscar el escenario
    $scenario = Scenario::findOrFail($id);

    $data = $request->validated();

    // Crear una nueva instrucción y asociarla al escenario
    $instruction = new Instruction();
    $instruction->name = $data['name'];
    $instruction->action = $data['action'];
    $instruction->description = $data['description'];

    // Manejar archivo de audio si se sube
    if ($request->hasFile('audio')) {
        $instruction->audio = $request->file('audio')->store('audios', 'public');
    }

    $instruction->scenario_id = $scenario->id;
    $instruction->save();

    // Redirigir a la vista del escenario
    return redirect()->route('scenarios.show', $scenario->id)
                     ->with('success', 'La Instrucción fue creada correctamente.');
}


    public function edit($id)
    {
        $datos = Instruction::findOrFail($id);

        return view('admin.instructions.edit', compact('datos'));
    }

    public function update(InstructionsRequest $request, $id)
    {
        $data = $request->validated();
    
        $instructions = Instruction::findOrFail($id);
        $instructions->name = $data['name'];
        $instructions->action = $data['action'];
        $instructions->description = $data['description'];
        $instructions->save();

        // Manejar archivo de audio si se sube
        if ($request->hasFile('audio')) {
            $instructions->audio = $request->file('audio')->store('audios', 'public');
            $instructions->save();
        }

        // Redirigir a la vista del escenario
        return redirect()->route('scenarios.show', $instructions->scenario_id)
                   ->with('success', 'La Instrucción fue creada correctamente.');
    }

    public function index()
    {
        $instructions = Instruction::all();

        return view('admin.instructions.index', compact('instructions'));
    }
}


