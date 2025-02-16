<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Actions\Fortify\PasswordValidationRules;

class UserRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            //'role' => ['required', 'string', 'in:student,teacher,admin']
        ];
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
