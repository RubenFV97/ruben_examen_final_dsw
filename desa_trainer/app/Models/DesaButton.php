<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaButton extends Model
{
    protected $table = 'desa_buttons'; 
    protected $fillable = [
        'desa_trainer_id',
        'instructions_id',
        'label',
        'cordinate',
        'color',
        'is_blinking',
    ];

    protected $casts = [
        'cordinate' => 'array',
    ];
    

    public const AVAILABLE_COLORS = [
        '#007bff' => 'Azul',
        '#28a745' => 'Verde',
        '#dc3545' => 'Rojo',
        '#ffc107' => 'Amarillo',
        '#6c757d' => 'Gris',
    ];

    public function desaTrainer()
    {
        return $this->belongsTo(DesaTrainer::class, 'desa_trainer_id');
    }

    public function instruction()
    {
        return $this->belongsTo(Instruction::class, 'instructions_id');
    }

}