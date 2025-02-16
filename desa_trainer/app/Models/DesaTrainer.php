<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaTrainer extends Model
{
    protected $table = 'desa_trainer'; // Cambia esto si tu tabla es 'desa_trainer'

    // Especifica los campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'name',
        'model',
        'description',
        'image',
        'settings',
    ];

    // Si el campo settings es JSON, puedes usar casts para trabajarlo como un array
    protected $casts = [
        'settings' => 'array',
    ];

    // Definir la relación con los botones
    public function buttons()
    {
        return $this->hasMany(DesaButton::class);
    }

    public function scenarios()
    {
        return $this->hasMany(Scenario::class, 'desatrainer_id');
    }
}


