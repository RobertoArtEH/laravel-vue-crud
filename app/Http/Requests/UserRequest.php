<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nombre" => "required|string",
            "apellidos" => "required|string",
            "sexo" => "required|string",
            "edad" => "required|integer"
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Nombre es un campo obligatorio',
            'apellidos.required'  => 'Apellidos es un campo obligatorio',
            'sexo.required'  => 'Sexo es un campo obligatorio',
            'edad.required'  => 'Edad es un campo obligatorio',
            'nombre.string'  => 'Nombre debe ser un string',
            'apellidos.string'  => 'Apellidos debe ser un string',
            'sexo.string'  => 'Sexo debe ser un string',
            'edad.integer'  => 'Edad debe ser un número entero',
        ];
    }
}
