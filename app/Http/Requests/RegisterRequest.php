<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'apellidos' => [''],
            'image' => [''],
            'carpeta' => '',
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'same:password'],
            'ci' => ['required', 'unique:users,ci'],
            'sexo' => ['required'],
            'phone' => ['required', 'unique:users,phone'],
            'domicilio' => [''],
            'estado' => [''],
            'tipoc' => ['required'],
            'tipoe' => ['required'],
            'latitud' => [''],
            'longitud' => [''],
            'id_ruta' => [''],
            'licencia' => [''],
            'cargo' => [''],
            'sueldo' => [''],
            'descripcion' => [''],
        ];
    }
}
