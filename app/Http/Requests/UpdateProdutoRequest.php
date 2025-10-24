<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdutoRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'conteudo' => 'nullable|string',
            'quantidade' => 'required|numeric',
            'marca' => 'nullable|string',
            'status' => 'in:0,1',
            'preco' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo titulo é obrigatório.',
            'titulo.string' => 'O titulo deve conter apenas texto.',
            'titulo.max' => 'O titulo não pode ter mais de 255 caracteres.',

            'conteudo.string' => 'O campo conteudo deve ser um texto válido.',

            'marca.string' => 'O campo marca deve conter apenas texto.',
            'marca.max' => 'O campo marca não pode ter mais de 100 caracteres.',

            'quantidade.required' => 'O campo quantidade de é obrigatório.',
            'quantidade.numeric' => 'O campo quantidade deve ser um número.',

            'preco.required' => 'O campo preço é obrigatório.',
            'preco.numeric' => 'O campo preço deve ser um número.',

            'status.required' => 'O status deve ser ativo ou inativo.',
        ];
    }
}
