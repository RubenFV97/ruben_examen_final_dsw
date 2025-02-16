<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Scenario;
use App\Models\Transition;
use App\Http\Requests\TransitionRequest;

class TransitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $scenario = Scenario::findOrFail($id);
        $instructions = $scenario->instructions; // Obtener las instrucciones relacionadas
        return view('admin.transitions.create', compact('scenario', 'instructions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransitionRequest $request, string $id)
    {

        switch ($request['trigger']) {
            case 'time':
                $request['desa_button_id'] = null;
                $request['loop_count'] = null;
                break;
            case 'user_choice':
                $request['time_seconds'] = null;
                $request['loop_count'] = null;
                break;
            case 'loop':
                $request['time_seconds'] = null;
                $request['desa_button_id'] = null;
                break;
            default:
                break;
        }
        $data = $request->validated();
        $transition = Transition::create($data);

        return redirect()->route('scenarios.show', $id)->with("success", "Transición creada con éxito");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $scenarioId, string $id)
    {
        $transition = Transition::findOrFail($id);
        $scenario = Scenario::findOrFail($scenarioId);
        $instructions = $scenario->instructions; // Obtener las instrucciones relacionadas

        return view('admin.transitions.show', compact('transition', 'instructions', 'scenario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $scenarioId, string $id)
    {
        $transition = Transition::findOrFail($id);
        $scenario = $transition->fromInstruction->scenario;
        $instructions = $scenario->instructions; // Obtener las instrucciones relacionadas
        return view('admin.transitions.edit', compact('transition', 'instructions', 'scenario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransitionRequest $request, string $scenarioId, string $id)
    {
        switch ($request['trigger']) {
            case 'time':
                $request['desa_button_id'] = null;
                $request['loop_count'] = null;
                break;
            case 'user_choice':
                $request['time_seconds'] = null;
                $request['loop_count'] = null;
                break;
            case 'loop':
                $request['time_seconds'] = null;
                $request['desa_button_id'] = null;
                break;
            default:
                break;
        }
        $data = $request->validated();
        $transition = Transition::findOrFail($id);
        $transition->update($data);
        return redirect()->route('scenarios.show', $transition->fromInstruction->scenario->id)->with("success", "Transición actualizada con éxito");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $scenarioId, string $id)
    {
        $transition = Transition::findOrFail($id);
        $scenarioId = $transition->fromInstruction->scenario->id;
        $transition->delete();
        return redirect()->route('scenarios.show', $scenarioId)->with("success", "Transición eliminada con éxito");
    }
}
