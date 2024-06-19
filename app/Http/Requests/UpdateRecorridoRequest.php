<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecorridoRequest extends FormRequest
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
            'fechaHora' => 'required',
            'horaIni' => 'required',
            'horaFin' => 'required',
            'coordenadas' => 'required',
            'id_equipoRecorrido' => 'required',
            'id_ruta' => 'required',
        ];
    }
}
