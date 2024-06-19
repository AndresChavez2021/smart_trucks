<?php

namespace App\Listeners;

use App\Events\SendNotifications;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PushNotificationslistener
{
    public function handle(SendNotifications $event)
    {

        $clientes = User::select(["users.name","token_push_notifications.expo_token","barrios.nombre"])
            ->join("token_push_notifications","token_push_notifications.user_id","=","users.id")
            ->join("barrios","barrios.id","=","users.id_barrio")
            ->where("users.id_barrio", $event->id_barrio)
            ->get();
        //   dd($clientes);
                         foreach ($clientes as $cliente) {
                            $message = "Hey! " . $cliente->name . " hay un camion cerca del barrio".$cliente->nombre;
                            $data = [
                                'title' => 'Smart Trucks',
                                'body' => $message,
                                'send' => [
                                    'barrio' => $cliente->nombre,
                                    'cliente' => $cliente->name,
                                ]
                            ];

                            // Enviar notificación a cada usuario del barrio
                            $this->sendNotification($message, $data, $cliente->expo_token);
                        }
    }


    function sendNotification($message, $data, $expoPushToken)
    {
        $client = new Client();
        $response = $client->post('https://exp.host/--/api/v2/push/send', [

            'headers' => [
                'Accept' => 'application/json',
                'Accept-Encoding' => 'gzip, deflate',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'to' => $expoPushToken,
                'sound' => 'default',
                'title' => $data['title'],
                'body' => $data['body'],
                'data' => $data['send'],
            ],
        ]);

        return $response->getBody();
    }
}
