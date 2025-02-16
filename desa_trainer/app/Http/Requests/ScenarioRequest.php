<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScenarioRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "short_description" => ["required", "string"],
            "long_description" => ["required", "string"],
            "desatrainer_id" => ["required", "exists:desa_trainer,id"],
            "image" => ["file", "mimes:jpeg,png,jpg"]
        ];
    }

    public function messages(): array
    {
        return [
                "name.required" => "Es necesario incluir un nombre",
                "name.max" => "El nombre no puede contener más de 255 carácteres",
                "short_description.required" => "Es necesario incluir una descripción corta",
                "long_description.required" => "Es necesario incluir una descripción larga",
                "desatrainer_id.required" => "Es necesario seleccionar un Desa Trainer",
                "desatrainer_id.exists" => "Tienes que seleccionar un desa trainer que exista",
                "image.image" => "Solo se admiten imagenes",
                "image.mimes" => "Solo se aceptan los formatos jpeg, png o jpg"
        ];
    }
}
