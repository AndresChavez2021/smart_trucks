<?php

namespace App\Http\Controllers\Api;

use App\Models\Ruta;
use App\Models\User;
use App\Models\Camion;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\EquipoRecorrido;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipoRecorridoRequest;
use App\Models\Barrio;
use App\Models\Categorias_reciclable;
use App\Models\Reclamo;
use App\Models\Recoleccion;
use App\Models\Recorrido;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChoferController extends Controller
{

    use ApiResponder;
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function listaEmpleados()
    {


        $empleados = User::select("id", "image", "name", "apellidos", "ci", "phone")->whereHas("roles", function ($q) {
            $q->whereIn("name", ["Ayudante", "Recogedor"]);
        })->get();

        $empleadosConRoles = $empleados->map(function ($empleado) {
            $nombresRoles = $empleado->roles->pluck('name');
            $empleado->roles = $nombresRoles;
            return $empleado;
        });

        return $this->success(
            "empleados",
            $empleadosConRoles
        );
    }

    public function listarCamiones()
    {
        return Camion::all();
    }

    /* public function registrarEquipoDeRecorrido(Request $request)
    {
        $id_empleado = $request->id_empleado;

        if (is_array($id_empleado) && count($id_empleado) > 0) {

            foreach ($id_empleado as $id_empleados) {
                $equipo = new EquipoRecorrido(['id_empleado' => $id_empleados]);
                $equipo->id_camion = $request->id_camion;
                $equipo->save();
            }
        } else {
            $equipo = new EquipoRecorrido(['id_empleado' => $request->id_empleado]);
            $equipo->id_camion = $request->id_camion;
            $equipo->save();
        }


        return $this->success(__("Registrado"), "Guardado");
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipoRecorridoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarEquipoDeRecorrido(StoreEquipoRecorridoRequest $request)
    {
        $empleados = $request->id_empleado;
        $ultimoId = EquipoRecorrido::max('id');
        if ($ultimoId == null) {
            // si el primero en ingresar es un array
            if (is_array($empleados) && count($empleados) > 0) {
                foreach ($empleados as $empleado) {
                    EquipoRecorrido::create([
                        'id' => '1',
                        'id_empleado' => $empleado,
                        'id_camion' => $request->id_camion,
                    ]);
                }
                return $this->success("registrado", [
                    "id" => 1,
                ]);
            } else {
                // si el primero en ingresar no es un array
                EquipoRecorrido::create([
                    'id' => '1',
                    'id_empleado' => $empleados,
                    'id_camion' => $request->id_camion,
                ]);
                return $this->success("registrado", [
                    "id" => 1,
                ]);
            }
        } else {
            // en caso de que  no sea el primero y no sea un array
            if (!is_array($empleados)) {
                EquipoRecorrido::create([
                    'id' => $ultimoId + 1,
                    'id_empleado' =>  $empleados,
                    'id_camion' => $request->id_camion,
                ]);
            }



            // en el caso de que no sea el primero y sea un array
            if (is_array($empleados) && count($empleados) > 0) {
                foreach ($empleados as $empleado) {
                    EquipoRecorrido::create([
                        'id' => $ultimoId + 1,
                        'id_empleado' => $empleado,
                        'id_camion' => $request->id_camion,
                    ]);
                }
            }

            return  $this->success("registrado", [
                "id" => $ultimoId + 1,
            ]);
        }
    }


    public function listarRutas()
    {

        $rutas = DB::table('rutas')
            ->select([
                "rutas.id",
                "rutas.origen",
                "rutas.destino",
                "rutas.nombre as nombreRuta",
                "horarios.dia_semana",
                "horarios.hora_inicio",
                "horarios.hora_fin",
                "distritos.nombre as nombreDistrito",
                "zonas.nombre as nombreZonas",
                ])
            ->join('horarios', 'horarios.id', '=', 'rutas.id_horario')
            ->join('establecimientos', 'establecimientos.id_ruta', '=', 'rutas.id')
            ->join('distritos', 'distritos.id', '=', 'establecimientos.id_distrito')
            ->join('zonas', 'zonas.id', '=', 'distritos.id_zona')
            ->get();

        return $this->success(
            "rutas",
            $rutas
        );
    }

    public function obtenerCoordenadaDeLaRuta(Request $request)
    {

        $coord= Ruta::select('coordenadas','origen')->where('id',$request->id_ruta)->get();

        return $this->success(
            "coord",
            $coord
        );
    }

    public function guardarRecorridoDelChofer(Request $request)
    {
        $converArrayAString = json_encode($request->coordenadas);
        $data = new Recorrido();
        $data->fechaHora = $request->fechaHora;
        $data->horaIni = $request->horaIni;
        $data->horaFin = $request->horaFin;
        $data->coordenadas = $converArrayAString;
        $data->id_ruta = $request->id_ruta;

        $data->id_equipoRecorrido = $request->id_equipoRecorrido;
        $data->save();

        return $this->success(
            "ok",

        );
    }
    public function listaBarrios(){
        $barrios=Barrio::all();
        return $this->success(
            "lista de barrios ",[
                "barrios"=>$barrios
            ]

        );
    }


    public function enviarNotificacionDellegada(Request $request ){

            $clientes = User::select(["users.name","token_push_notifications.expo_token","barrios.nombre"])
            ->join("token_push_notifications","token_push_notifications.user_id","=","users.id")
            ->join("barrios","barrios.id","=","users.id_barrio")
            // ->where("users.id",Auth::user()->id)
            ->get();
            // dd($clientes);
                         foreach ($clientes as $cliente) {
                            $message = "Hey! " . $cliente->name . " hay un camion cerca tu barrio ";
                            $data = [
                                'title' => 'Smart Trucks',
                                'body' => $message,
                                'send' => [
                                    'barrio' => "",
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


    public function calculoReciclaje(Request $request){

        $reciclaje=new Recoleccion();
        $reciclaje->fechaHora=Carbon::now()->format('Y-m-d H:i:s');
        $reciclaje->peso=$request->peso;
        $reciclaje->id_categoria=$request->id_categoria;
        $reciclaje->id_usuario=$request->id_usuario;
        $reciclaje->save();

        return $this->success(
            "Calculo registrado ");

    }



    public function recoleccionesPorCategoria(Request $request)
    {
        // Obtener las recolecciones agrupadas por categoría para un usuario específico
        $recolecciones = Recoleccion::select('id_categoria', DB::raw('count(*) as total'))
            ->where('id_usuario', $request->id_usuario)
            ->groupBy('id_categoria')
            ->get();

        // Mapear las recolecciones para incluir el nombre de la categoría
        $result = $recolecciones->map(function ($item) {
            $categoria = Categorias_reciclable::find($item->id_categoria);
            return [
                'nombre' => $categoria->nombre,
                'total' => $item->total
            ];
        });

        return response()->json($result);
    }

public function categoriasConUsuariosMasUsados()
{
    $categoriasConUsuarios = Recoleccion::select('id_categoria', DB::raw('count(id_usuario) as total'))
        ->groupBy('id_categoria')
        ->orderBy('total', 'desc')
        ->get();

    $result = $categoriasConUsuarios->map(function ($item) {
        $categoria = Categorias_reciclable::find($item->id_categoria);
        return [
            'nombre' => $categoria->nombre,
            'total' => $item->total
        ];
    });

    return response()->json($result);
}

public function guardarReclamo(Request $request)
{


    // Guardar la imagen
    if ($request->hasFile('foto')) {
        $imagen = $request->file('foto');
        $rutaImagen = $imagen->store('reclamos', 'public'); // Almacena la imagen en storage/app/public/reclamos
        $fotoUrl = Storage::url($rutaImagen);
    } else {
        $fotoUrl = null;
    }

    // Guardar en la base de datos
    $reclamo = new Reclamo();
    $reclamo->descripcion = $request->descripcion;
    $reclamo->fechaHora = Carbon::now()->format('Y-m-d H:i:s');
    $reclamo->foto = $fotoUrl;
    $reclamo->coordenada = $request->coordenada;
    $reclamo->id_cliente = $request->id_cliente;
    $reclamo->save();

    return response()->json(['message' => 'Reclamo guardado correctamente'], 201);
}

}
