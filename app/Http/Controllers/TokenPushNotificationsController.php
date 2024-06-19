<?php

namespace App\Http\Controllers;

use App\Models\TokenPushNotifications;
use Illuminate\Http\Request;

class TokenPushNotificationsController extends Controller
{
    public function registrarExpoToken(Request $request) //para tutor y hijo
    {

        $existeToken = TokenPushNotifications::where('expo_token', $request->expo_token)->first();
        if (!$existeToken) {
            $registrar = TokenPushNotifications::create([
                'expo_token' => $request->expo_token,
                'user_id' => $request->user_id,
            ]);
            return response()->json([
                'data' => $registrar
            ]);
        } else {
            return response()->json([
                'data' => "Este token ya existe"
            ]);
        }
    }
}
