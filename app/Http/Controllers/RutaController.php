<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use App\Http\Requests\StoreRutaRequest;
use App\Http\Requests\UpdateRutaRequest;
use App\Models\AreaCritica;
use App\Models\Distrito;
use App\Models\Horario;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rutas = ruta::select('*')->orderBy('id','ASC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $rutas = $rutas->where('id','like','%'.$request->search.'%')
            ->orWhere('nombre','like','%'.$request->search.'%')
            ->orWhere('descripcion','like','%'.$request->search.'%')
            ->orWhere('origen','like','%'.$request->search.'%')
            ->orWhere('destino','like','%'.$request->search.'%')
            ->orWhere('coordenadas','like','%'.$request->search.'%');
        }
        $rutas = $rutas->paginate($limit)->appends($request->all());
        return view('rutas.index', compact('rutas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puntos = [];
        $horarios = Horario::get();
        return view('rutas.create', compact('horarios', 'puntos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRutaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRutaRequest $request)
    {
        Ruta::create($request->validated());
        return redirect()->route('rutas.index')->with('mensaje', 'ruta Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ruta = ruta::where('id', '=', $id)->firstOrFail();
        $puntos = json_decode($ruta->coordenadas);
        $origen = json_decode($ruta->origen);
        $destino = json_decode($ruta->destino);
        $horarios = Horario::get();
        return view('rutas.show', compact('ruta', 'puntos', 'origen', 'destino', 'horarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruta = ruta::where('id', '=', $id)->firstOrFail();
        $puntos = json_decode($ruta->coordenadas);
        $origen = json_decode($ruta->origen);
        $destino = json_decode($ruta->destino);
        $horarios = Horario::get();
        $areasCriticas = AreaCritica::where('id_ruta', $ruta->id)->get();
        return view('rutas.edit', compact('ruta', 'puntos', 'origen', 'destino', 'horarios', 'areasCriticas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRutaRequest  $request
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRutaRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruta  $ruta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruta = ruta::findOrFail($id);
        try{
            $ruta->delete();
            return redirect()->route('rutas.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('rutas.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
