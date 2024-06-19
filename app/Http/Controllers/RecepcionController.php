<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use App\Http\Requests\StoreRecepcionRequest;
use App\Http\Requests\UpdateRecepcionRequest;
use App\Models\Basura;
use App\Models\Recorrido;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recepciones = DB::table('recepcions')
            ->join('recorridos', 'recepcions.id_recorrido', '=', 'recorridos.id')
            ->join('basuras', 'recepcions.id_basura', '=', 'basuras.id')
            ->select(
                'recepcions.id',
                'recepcions.fechaHora',
                'recepcions.cantidad',
                'recepcions.observacion',
                'recorridos.horaIni AS recorridoHI',
                'recorridos.horaFin AS recorridoHF',
                'basuras.tipo AS basura'
            )
            ->orderBy('recepcions.fechaHora', 'DESC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $recepciones = $recepciones->where('recepcions.id','like','%'.$request->search.'%')
            ->orWhere('recepcions.fechaHora','like','%'.$request->search.'%')
            ->orWhere('recepcions.cantidad','like','%'.$request->search.'%')
            ->orWhere('recepcions.observacion','like','%'.$request->search.'%')
            ->orWhere('recorridos.horaIni','like','%'.$request->search.'%')
            ->orWhere('recorridos.horaFin','like','%'.$request->search.'%')
            ->orWhere('basuras.tipo','like','%'.$request->search.'%');
        }
        $recepciones = $recepciones->paginate($limit)->appends($request->all());
        return view('recepciones.index', compact('recepciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recorridos = Recorrido::get();
        $recorridos = DB::table('recorridos')
        ->join('rutas', 'recorridos.id_ruta', '=', 'rutas.id')
        ->select(
            'recorridos.id',
            'recorridos.fechaHora',
            'rutas.nombre AS ruta'
        )
        ->orderBy('recorridos.fechaHora', 'DESC')->get();
        $basuras = Basura::get();
        return view('recepciones.create', compact('recorridos', 'basuras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecepcionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecepcionRequest $request)
    {
        recepcion::create($request->validated());
        return redirect()->route('recepciones.index')->with('mensaje', 'recepcion Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recepcion = recepcion::where('id', '=', $id)->firstOrFail();
        $recorridos = Recorrido::get();
        $basuras = Basura::get();
        return view('recepciones.show', compact('recepcion', 'recorridos', 'basuras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recepcion = recepcion::where('id', '=', $id)->firstOrFail();
        $recorridos = Recorrido::get();
        $basuras = Basura::get();
        return view('recepciones.edit', compact('recepcion', 'recorridos', 'basuras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecepcionRequest  $request
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecepcionRequest $request, $id)
    {
        $recepcion = recepcion::find($id);
        $recepcion->update($request->validated());
        return redirect()->route('recepciones.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recepcion = recepcion::findOrFail($id);
        try{
            $recepcion->delete();
            return redirect()->route('recepciones.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('recepciones.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
