<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from_instruction_id' => ['required', 'exists:instructions,id'],
            'to_instruction_id' => ['required', 'exists:instructions,id'],
            'trigger' => ['required', 'string', 'in:time,user_choice,loop'],
            'time_seconds' => ['required_if:trigger,time', 'integer', 'nullable'],
            'desa_button_id' => ['required_if:trigger,user_choice', 'exists:buttons,id', 'nullable'],
            'loop_count' => ['required_if:trigger,loop', 'integer', 'nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'from_instruction_id.required' => 'El campo de instrucción de origen es obligatorio.',
            'from_instruction_id.exists' => 'La instrucción de origen no existe.',
            'to_instruction_id.required' => 'El campo de instrucción de destino es obligatorio.',
            'to_instruction_id.exists' => 'La instrucción de destino no existe.',
            'trigger.required' => 'El campo de activación es obligatorio.',
            'trigger.string' => 'El campo de activación debe ser una cadena de texto.',
            'trigger.in' => 'El campo de activación debe ser time, user_choice o loop.',
            'time_seconds.required_if' => 'El campo de segundos es obligatorio cuando el campo de activación es time.',
            'time_seconds.integer' => 'El campo de segundos debe ser un número entero.',
            'desa_button_id.required_if' => 'El campo de botón de desa es obligatorio cuando el campo de activación es user_choice.',
            'desa_button_id.exists' => 'El botón de desa no existe.',
            'loop_count.required_if' => 'El campo de conteo de bucle es obligatorio cuando el campo de activación es loop.',
            'loop_count.integer' => 'El campo de conteo de bucle debe ser un número entero.'
        ];

    }
}
