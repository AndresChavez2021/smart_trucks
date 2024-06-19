<?php

namespace App\Http\Controllers;

use App\Models\Recorrido;
use App\Http\Requests\StoreRecorridoRequest;
use App\Http\Requests\UpdateRecorridoRequest;
use App\Models\AreaCritica;
use App\Models\Ruta;
use Illuminate\Http\Request;

class RecorridoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recorridos = Recorrido::select('*')->orderBy('fechaHora','DESC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $recorridos = $recorridos->where('id','like','%'.$request->search.'%')
            ->orWhere('fechaHora','like','%'.$request->search.'%')
            ->orWhere('horaIni','like','%'.$request->search.'%')
            ->orWhere('horaFin','like','%'.$request->search.'%')
            ->orWhere('coordenadas','like','%'.$request->search.'%');
        }
        $recorridos = $recorridos->paginate($limit)->appends($request->all());
        return view('recorridos.index', compact('recorridos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecorridoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecorridoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recorrido = Recorrido::findOrFail($id);
        $ruta = Ruta::findOrFail($recorrido->id_ruta);
        $puntos = json_decode($ruta->coordenadas);
        $puntosR = json_decode($recorrido->coordenadas);
        $areasCriticas = AreaCritica::where('id_ruta', $ruta->id)->get();
        return view('recorridos.show', compact('ruta', 'puntos', 'recorrido', 'puntosR', 'areasCriticas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecorridoRequest  $request
     * @param  \App\Models\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecorridoRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recorrido  $recorrido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
