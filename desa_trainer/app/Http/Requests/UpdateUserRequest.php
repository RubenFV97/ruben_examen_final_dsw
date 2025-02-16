<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class UpdateUserRequest extends FormRequest
{
    use PasswordValidationRules;
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
            'email' => 'required|email|unique:users,email,' . $this->route('user'),
            'role' => ['required', 'string', 'in:student,teacher,admin']
        ];

        // Si la contraseña está presente, agrega reglas específicas
        if ($this->filled('password')) {
            $rules['password'] = $this->passwordRules();
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Es necesario un nombre',
            'name.max' => 'El nombre no puede tener mas de 255 carácteres',
            'email.required' => 'Es necesario insertar un email',
            'email.email' => 'El email tiene que ser válido',
            'email.unique' => 'El email introducido ya esta registrado',
            'email.max' => 'El email no puede tener mas de 255 carácteres',
            'password.required' => 'Es necesario que introduzcas una contraseña',
            'password.confirmed' => 'La contraseña no coincide con la confirmación',
            'password.min' => 'La contraseña tiene que tener mínimo 8 carácteres'
        ];
    }

}
