<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

use App\Models\User;

class LoginRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', 'min:6', Rules\Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode conter mais que 255 caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string.',
            'email.lowercase' => 'O e-mail deve estar em letras minúsculas.',
            'email.email' => 'O campo e-mail deve conter um endereço válido.',
            'email.max' => 'O e-mail não pode conter mais que 255 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'A senha deve ser uma string.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha deve conter pelo menos 6 caracteres.',
        ];
    }
}
