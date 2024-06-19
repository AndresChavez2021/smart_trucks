<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponder;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    use ApiResponder;
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        request()->validate([
            "email" => "required|email",
            "password" => "required|min:6|max:20",
            "device_name" => "required"

        ]);


        $cliente = User::select(["id", "name", "password", "email"])
            ->where("email", request("email"))->first();
            // ->where("tipoc","1")


        /* Verificacion si el cliente existe */
        if (!$cliente) {
            throw ValidationException::withMessages([
                "email" => [__("Credenciales incorrectas")]
            ]);
        }

        $token = $cliente->createToken(request("device_name"))->plainTextToken;


        return $this->success(
            __("Bienvenid@"),
            [
                "cliente" => $cliente->toArray(),

                "token" => $token,
            ]
        );
    }


    //TODO: PARA EL REGISTRO DEL CLIENTE
    public function signup(): JsonResponse
    {
        request()->validate([
            "name" => "required|min:2|max:60",
            "email" => "required",
            "password" => "required",

        ]);

        User::create([
            "name" => request("name"),
            "password" => bcrypt(request("password")),
            "id_barrio" => request("id_barrio"),

            // "apellidos" => request("apellidos"),
            "email" => request("email"),
            // "ci" => request("ci"),
            // "sexo" => request("sexo"),
            // "phone" => request("phone"),
            "tipoc" =>"1",
            "tipoe" => "0",
            "created_at" => now(),

        ]);

        return $this->success(
            __("Cuenta creada")
        );
    }


    //TODO: Funcion para cerrar sesion
    public function logout(): JsonResponse
    {
        //Recuperando el token
        $token = request()->bearerToken();

        /** @var PersonalAccessToken $model */

        $model = Sanctum::$personalAccessTokenModel;

        $accessToken = $model::findToken($token);
        /* si existe el token se eliminara */

        $accessToken->delete();


        return $this->success(
            __("Has cerrado sesion con exito!"),
            data: null,
            code: 204,

        );
    }



    public function obtenerBarrios (){

        $listaBarrios= Barrio::select(["id","nombre"])->get();
        return $this->success(
            __("listaBarrios"),
            [
                "barrios" => $listaBarrios->toArray(),

            ]
        );
    }
}

