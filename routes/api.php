<?php

use App\Http\Controllers\API\AuthChoferController;
use App\Http\Controllers\API\ChoferController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\TokenPushNotificationsController;
use App\Models\TokenPushNotifications;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthChoferController::class, 'login']);

Route::post('/cliente/login', [ClientController::class, 'login']);
Route::post('/cliente/signup', [ClientController::class, 'signup']);
Route::get('/cliente/barrios', [ClientController::class, 'obtenerBarrios']);
Route::post('register-notification', [TokenPushNotificationsController::class, 'registrarExpoToken']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    /* CHOFER */
    Route::post('/logout', [AuthChoferController::class, 'logout']);
    Route::get('/listaEmpleados', [ChoferController::class, 'listaEmpleados']);
    Route::get('/listarCamiones', [ChoferController::class, 'listarCamiones']);
    Route::post('/registrarEquipoDeRecorrido', [ChoferController::class, 'registrarEquipoDeRecorrido']);
    Route::get('/listarRutas', [ChoferController::class, 'listarRutas']);
    Route::post('/obtenerCoordenadaDeLaRuta', [ChoferController::class, 'obtenerCoordenadaDeLaRuta']);
    Route::post('/guardarRecorridoDelChofer', [ChoferController::class, 'guardarRecorridoDelChofer']);
    Route::get('/listaBarrios', [ChoferController::class, 'listaBarrios']);
    Route::post('/sendNotifications', [ChoferController::class, 'enviarNotificacionDellegada']);

    /* CLIENTE  */

    Route::post('/cliente/logout', [ClientController::class, 'logout']);

});
