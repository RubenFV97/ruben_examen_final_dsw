<?php

namespace App\Http\Controllers;

use App\Models\DesaTrainer;
use App\Models\Scenario;
use App\Models\Instruction; // Asegúrate de importar el modelo Instruction
use App\Models\Transition;
use Illuminate\Http\Request;
use App\Http\Requests\ScenarioRequest;
use App\Http\Requests\UpdateScenarioRequest;

class ScenarioController extends Controller
{
    /**
     * The search term for filtering transitions.
     *
     * @var string|null
     */
    protected $search;

    /**
     * Display a listing of the resource.
    */
    public function index()
    {
       $scenarios = Scenario::with('desatrainer')->get();

       return view('admin.scenarios.index', compact('scenarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desas = DesaTrainer::all(["id", "name"]);

        return view('admin.scenarios.create-scenarios', compact('desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScenarioRequest $request)
    {
        $data = $request->validated();

        // Inicializar el path de la imagen como vacío o null
        $filePath = null;

        // Verificar si se subió una imagen
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $filePath = $request->file('image')->storeAs('images', $fileName, 'public');
        }

        // Crear el escenario con los datos validados
        $scenario = Scenario::create($data);

        // Si hay una imagen, actualizar el campo 'image'
        if ($filePath) {
            $scenario->update(["image" => $filePath]);
        }

        return redirect()->route('scenarios.index')->with("success", "Escenario creado con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scenario = Scenario::findOrFail($id);
        $desatrainer = DesaTrainer::findOrFail($scenario->desatrainer_id);
        $instructions = $scenario->instructions; // Obtener las instrucciones relacionadas

        // Obtener todas las transiciones relacionadas con las instrucciones del escenario
        $transitions = Transition::whereIn('from_instruction_id', $instructions->pluck('id'))
            ->orWhereIn('to_instruction_id', $instructions->pluck('id'))
            ->get();

        return view("admin.scenarios.show-scenario", compact("scenario", "desatrainer", "instructions", "transitions"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $scenario = Scenario::findOrFail($id);
        $desas = DesaTrainer::all(["id", "name"]);
        return view("admin.scenarios.edit-scenarios", compact("scenario", "desas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScenarioRequest $request, string $id)
    {
        $scenario = Scenario::findOrFail($id);
        $data = $request->validated();
        
        // Asegurar que el status se guarda como una cadena con comillas
        $scenario->update([
            "name" => $data['name'],
            "short_description" => $data['short_description'],
            "long_description" => $data['long_description'],
            "desatrainer_id" => $data['desatrainer_id'],
            "status" => $data['status'], // Aquí el status ya estará validado
            "image" => $scenario->image,
        ]);

        // Si se sube una nueva imagen, actualizarla
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $filePath = $request->file('image')->storeAs('images', $fileName, 'public');
            $scenario->update(["image" => $filePath]);
        }

        return redirect()->route('scenarios.index')->with("success", "Escenario editado con éxito");
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scenario = Scenario::findOrFail($id);
        $scenario->delete();
        return redirect()->route('scenarios.index')->with("success", "Escenario borrado con éxito");
    }

    // !!!!!! Si copiais de chatGPT aseguraos de que el código lo poneis donde toca ¡¡¡¡¡¡
    // En el modelo Scenario (opcional, pero útil si necesitas acceder a las instrucciones relacionadas)
    // public function instructions()
    // {
    //     return $this->hasMany(Instruction::class);
    // }



}
