<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScenarioRequest extends FormRequest
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
        $rules = [
            "name" => ["required", "string", "max:255"],
            "short_description" => ["required", "string"],
            "long_description" => ["required", "string"],
            "desatrainer_id" => ["required", "exists:desa_trainer,id"],
            "status" => ["required", "in:pendiente,en_proceso,finalizado"],
        ];

        // Validar si se sube una imagen
        if ($this->file('image')) {
            $rules['image'] = ["required", "file", "mimes:jpeg,png,jpg"];
        }

        return $rules;
    }

    /**
     * Custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "name.required" => "Es necesario incluir un nombre",
            "name.max" => "El nombre no puede contener más de 255 carácteres",
            "short_description.required" => "Es necesario incluir una descripción corta",
            "long_description.required" => "Es necesario incluir una descripción larga",
            "desatrainer_id.required" => "Es necesario seleccionar un Desa Trainer",
            "desatrainer_id.exists" => "Tienes que seleccionar un desa trainer que exista",
            "status.required" => "Es necesario seleccionar un estado", // Mensaje de error para el campo 'status'
            "status.in" => "El estado debe ser uno de los siguientes: pendiente, en_proceso, finalizado", // Mensaje si el valor de 'status' no es válido
            "image.required" => "Es necesario incluir una imagen",
            "image.image" => "Solo se admiten imágenes",
            "image.mimes" => "Solo se aceptan los formatos jpeg, png o jpg"
        ];
    }
}
