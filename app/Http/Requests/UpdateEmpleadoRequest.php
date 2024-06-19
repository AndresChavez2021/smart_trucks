<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
            'email' => ['required'],
            'password' => [''],
            'password_confirmation' => [''],
            'ci' => ['required'],
            'sexo' => ['required'],
            'phone' => ['required'],
            'domicilio' => ['required'],
            'estado' => [''],
            'tipoc' => ['required'],
            'tipoe' => ['required'],
            'latitud' => [''],
            'longitud' => [''],
            'id_ruta' => [''],
            'licencia' => [''],
            'cargo' => [''],
            'sueldo' => ['required'],
            'descripcion' => [''],
        ];
    }
}
