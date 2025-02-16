<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scenario extends Model
{
    protected $table = 'scenarios';

    protected $fillable = [
        'id',
        'name',
        'short_description',
        'long_description',
        'image',
        'desatrainer_id',
        'status',
    ];

    public function desatrainer()
    {
        return $this->belongsTo(DesaTrainer::class, 'desatrainer_id');
    }

    /**
     * Relación con el modelo Instruction: un escenario tiene muchas instrucciones.
     */
    public function instructions(): HasMany
    {
        return $this->hasMany(Instruction::class, 'scenario_id');
    }

    public function updateStatus(Request $request, Scenario $scenario)
    {
        // Validar la entrada
        $request->validate([
            'status' => 'required|in:pendiente,en_proceso,finalizado',
        ]);

        // Actualizar el estado del escenario
        $scenario->status = $request->status;
        $scenario->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('scenarios.show', $scenario->id)
                        ->with('success', 'Estado del escenario actualizado correctamente');
    }




}
