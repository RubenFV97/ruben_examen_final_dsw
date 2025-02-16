<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = ['id', 'name', 'action', 'audio', 'description'];

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }

    public function transitionsFrom()
    {
        return $this->hasMany(Transition::class, 'from_instruction_id');
    }

    public function transitionsTo()
    {
        return $this->hasMany(Transition::class, 'to_instruction_id');
    }

}
