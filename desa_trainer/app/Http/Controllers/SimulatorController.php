<?php

namespace App\Http\Controllers;

use App\Models\Scenario;
use App\Models\DesaTrainer;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los DESA Trainers
        $desas = DesaTrainer::all();
    
        // Filtrar los escenarios por DESA Trainer si se selecciona uno
        $query = Scenario::where('status', 'finalizado'); // Solo escenarios finalizados
    
        // Si hay un DESA Trainer seleccionado, filtrar los escenarios por su ID
        if ($request->has('desatrainer_id') && $request->desatrainer_id != '') {
            $query->where('desatrainer_id', $request->desatrainer_id);
        }
    
        // Si hay una búsqueda de escenarios, filtrar por nombre
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Obtener todos los escenarios sin paginación
        $scenarios = $query->with('desatrainer')->get();
        //dd(\view('simulator.index', compact('scenarios', 'desas')));
        // Pasar los escenarios y DESA Trainers a la vista
        return view('simulatorIndex', compact('scenarios', 'desas'));
    }
}
