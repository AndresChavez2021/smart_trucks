<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthChoferController extends Controller
{
    use ApiResponder;
    public function lista()
    {
        return  User::whereHas("roles", function ($q) {
            $q->where("name", "Conductor");
        })->get();
        //    return  User::has('roles')->paginate(20);
    }

    public function login(): JsonResponse
    {
        request()->validate([
            "email" => "required|email",
            "password" => "required|min:6|max:20",
            "device_name" => "required"

        ]);


        $conductor = User::select(["id", "name", "password", "email"])
            ->where("email", request("email"))
            ->whereHas("roles", function ($q) {
                $q->where("name", "Conductor");
            })
            ->first();

        /* Verificacion si el conductor existe */
        if (!$conductor || !Hash::check(request("password"), $conductor->password)) {
            throw ValidationException::withMessages([
                "email" => [__("Credenciales incorrectas")]
            ]);
        }

        $token = $conductor->createToken(request("device_name"))->plainTextToken;


        return $this->success(
            __("Bienvenid@"),
            [
                "conductor" => $conductor->toArray(),

                "token" => $token,
            ]
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
}
