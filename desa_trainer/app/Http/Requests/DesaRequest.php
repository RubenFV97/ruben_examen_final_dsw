<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesaRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'settings' => 'nullable|string',
        ];

        return $rules;
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'model.required' => 'El modelo es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'image.required' => 'No se ha seleccionado una imagen.',
            'image.image' => 'La imagen debe ser un archivo de tipo imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg, gif o svg.',
            'image.max' => 'La imagen no debe pesar más de 5 MB.',
        ];
    }

}
