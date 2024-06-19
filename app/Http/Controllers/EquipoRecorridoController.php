<?php

namespace App\Http\Controllers;

use App\Models\EquipoRecorrido;
use App\Http\Requests\StoreEquipoRecorridoRequest;
use App\Http\Requests\UpdateEquipoRecorridoRequest;
use App\Models\Camion;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipoRecorridoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $equiposRecorridos = DB::table('equipo_recorridos')
            ->join('users', 'equipo_recorridos.id_empleado', '=', 'users.id')
            ->join('camions', 'equipo_recorridos.id_camion', '=', 'camions.id')
            ->select(
                'equipo_recorridos.id',
                'camions.nombre AS camion',
                'users.name AS empleado'
            )
            ->orderBy('equipo_recorridos.id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $equiposRecorridos = $equiposRecorridos->where('equipo_recorridos.id', 'like', '%' . $request->search . '%')
                ->orWhere('camions.nombre', 'like', '%' . $request->search . '%')
                ->orWhere('users.name', 'like', '%' . $request->search . '%');
        }
        $equiposRecorridos = $equiposRecorridos->paginate($limit)->appends($request->all());
        return view('equiposRecorridos.index', compact('equiposRecorridos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Nro = [];
        $camions = Camion::get();
        $empleados = User::where('tipoe', 1)->get();
        return view('equiposRecorridos.create', compact('Nro', 'empleados', 'camions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipoRecorridoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipoRecorridoRequest $request)
    {
        $empleados = $request->empleados;
        $ultimoId = EquipoRecorrido::max('id');
        if ($ultimoId == null) {
            foreach ($empleados as $empleado) {
                EquipoRecorrido::create([
                    'id' => '1',
                    'id_empleado' => $empleado,
                    'id_camion' => $request->id_camion,
                ]);
            }
        } else {
            foreach ($empleados as $empleado) {
                EquipoRecorrido::create([
                    'id' => $ultimoId + 1,
                    'id_empleado' => $empleado,
                    'id_camion' => $request->id_camion,
                ]);
            }
        }
        return redirect()->route('equiposRecorridos.index')->with('mensaje', 'Equipo Recorrido Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipoRecorrido  $equipoRecorrido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipoRecorrido = EquipoRecorrido::where('id', '=', $id)->firstOrFail();
        $EquiposRecorridos = EquipoRecorrido::where('id', '=', $id)->get();
        $Nro = [];
        foreach ($EquiposRecorridos as $EquipoRecorrido) {
            array_push($Nro, $EquipoRecorrido->id_empleado);
        }
        $camions = Camion::get();
        $empleados = User::where('tipoe', 1)->get();
        return view('equiposRecorridos.show', compact('Nro', 'equipoRecorrido', 'camions', 'empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipoRecorrido  $equipoRecorrido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipoRecorrido = EquipoRecorrido::where('id', '=', $id)->firstOrFail();
        $EquiposRecorridos = EquipoRecorrido::where('id', '=', $id)->get();
        $Nro = [];
        foreach ($EquiposRecorridos as $EquipoRecorrido) {
            array_push($Nro, $EquipoRecorrido->id_empleado);
        }
        $camions = Camion::get();
        $empleados = User::where('tipoe', 1)->get();
        return view('equiposRecorridos.edit', compact('Nro', 'equipoRecorrido', 'camions', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEquipoRecorridoRequest  $request
     * @param  \App\Models\EquipoRecorrido  $equipoRecorrido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipoRecorridoRequest $request, $id)
    {
        EquipoRecorrido::where('id', $id)->delete();
        $empleados = $request->empleados;
        foreach ($empleados as $empleado) {
            EquipoRecorrido::create([
                'id' => $id,
                'id_empleado' => $empleado,
                'id_camion' => $request->id_camion,
            ]);
        }
        return redirect()->route('equiposRecorridos.index')->with('mensaje', 'Equipo Recorrido Agregado Con Éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipoRecorrido  $equipoRecorrido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            EquipoRecorrido::where('id', $id)->delete();
            return redirect()->route('equiposRecorridos.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('equiposRecorridos.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
