<?php

use App\Http\Controllers\AlarmaController;
use App\Http\Controllers\AreaCriticaController;
use App\Http\Controllers\BasuraController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EquipoRecorridoController;
use App\Http\Controllers\EstablecimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecepcionController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\RecorridoController;
use App\Http\Controllers\RedController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\BarrioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [RegisterController::class, 'show']);

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::group(['middleware' => ['auth']], function () {
    route::resource('/empleados', EmpleadoController::class);
    route::resource('/clientes', ClienteController::class);
    route::resource('/users', UserController::class);
    route::resource('/perfil', PerfilController::class);
    route::resource('/password', PasswordController::class);
    route::resource('/roles', RolController::class);
    route::resource('/horarios', HorarioController::class);
    route::resource('/rutas', RutaController::class);
    route::resource('/areasCriticas', AreaCriticaController::class);
    route::resource('/distritos', DistritoController::class);
    route::resource('/zonas', ZonaController::class);
    route::resource('/alarmas', AlarmaController::class);
    route::resource('/reclamos', ReclamoController::class);
    route::resource('/equiposRecorridos', EquipoRecorridoController::class);
    route::resource('/recorridos', RecorridoController::class);
    route::resource('/basuras', BasuraController::class);
    route::resource('/camiones', CamionController::class);
    route::resource('/redes', RedController::class);
    route::resource('/establecimientos', EstablecimientoController::class);
    route::resource('/recepciones', RecepcionController::class);
    route::resource('/barrios', BarrioController::class);
    route::resource('/datasets', DatasetController::class);
    Route::get('/datasets/query/{id}', [DatasetController::class, 'query'])->name('datasets.query');
    Route::post('/datasets/query', [DatasetController::class, 'queryStore'])->name('datasets.queryStore');
});
