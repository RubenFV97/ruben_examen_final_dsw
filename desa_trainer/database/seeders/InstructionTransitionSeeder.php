<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruction;
use App\Models\Transition;
use App\Models\Scenario;
use App\Models\DesaTrainer;

class InstructionTransitionSeeder extends Seeder
{
    public function run()
    {
        // Crear un desa trainer de ejemplo
        $desaTrainer = DesaTrainer::create([
            'name' => 'Desa Trainer de Prueba',
            'model' => 'Modelo de Prueba',
            'description' => 'Descripción del Desa Trainer de Prueba',
            'image' => 'imagen.jpg'
        ]);


        // Crear un escenario de ejemplo
        $scenario = Scenario::create([
            'name' => 'Escenario de Prueba',
            'short_description' => 'Descripción del escenario de prueba',
            'long_description' => 'Descripción larga del escenario de prueba',
            'image' => 'imagen.jpg',
            'desatrainer_id' => $desaTrainer->id
        ]);

        // Crear instrucciones de ejemplo
        $instructions = [
            [
                'name' => 'Instrucción 1',
                'action' => 'Acción 1',
                'order_position' => 1,
                'description' => 'Descripción de la instrucción 1',
                'scenario_id' => $scenario->id
            ],
            [
                'name' => 'Instrucción 2',
                'action' => 'Acción 2',
                'order_position' => 2,
                'description' => 'Descripción de la instrucción 2',
                'scenario_id' => $scenario->id
            ]
        ];

        $instructionsCreated = [];
        foreach ($instructions as $instruction) {
            $createdInstruction = Instruction::create($instruction);
            $instructionsCreated[] = $createdInstruction;
        }

        // Crear transiciones de ejemplo
        $transitions = [
            [
                'from_instruction_id' => $instructionsCreated[0]['id'],
                'to_instruction_id' => $instructionsCreated[1]['id'],
                'trigger' => 'time',
                'time_seconds' => 10,
                'is_initial' => true
            ],
            [
                'from_instruction_id' => $instructionsCreated[1]['id'],
                'to_instruction_id' => $instructionsCreated[1]['id'],
                'trigger' => 'loop',
                'loop_count' => 3
            ]
        ];

        foreach ($transitions as $transition) {
            Transition::create($transition);
        }
    }
}