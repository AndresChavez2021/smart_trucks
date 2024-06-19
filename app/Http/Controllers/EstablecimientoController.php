<?php

namespace App\Http\Controllers;

use App\Models\establecimiento;
use App\Http\Requests\StoreestablecimientoRequest;
use App\Http\Requests\UpdateestablecimientoRequest;
use App\Models\Distrito;
use App\Models\Red;
use App\Models\Ruta;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $establecimientos = DB::table('establecimientos')
            ->join('rutas', 'establecimientos.id_ruta', '=', 'rutas.id')
            ->join('distritos', 'establecimientos.id_distrito', '=', 'distritos.id')
            ->join('reds', 'establecimientos.id_red', '=', 'reds.id')
            ->select(
                'establecimientos.id',
                'establecimientos.nombre',
                'rutas.nombre AS ruta',
                'distritos.nombre AS distrito',
                'reds.nombre AS red',
            )
            ->orderBy('establecimientos.id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $establecimientos = $establecimientos->where('establecimientos.id', 'like', '%' . $request->search . '%')
                ->orWhere('establecimientos.nombre', 'like', '%' . $request->search . '%')
                ->orWhere('rutas.nombre', 'like', '%' . $request->search . '%')
                ->orWhere('distritos.nombre', 'like', '%' . $request->search . '%')
                ->orWhere('reds.nombre', 'like', '%' . $request->search . '%');
        }
        $establecimientos = $establecimientos->paginate($limit)->appends($request->all());
        return view('establecimientos.index', compact('establecimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutas = Ruta::get();
        $distritos = Distrito::get();
        $redes = Red::get();
        return view('establecimientos.create', compact('rutas', 'distritos', 'redes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreestablecimientoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreestablecimientoRequest $request)
    {
        establecimiento::create($request->validated());
        return redirect()->route('establecimientos.index')->with('mensaje', 'establecimiento Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $establecimiento = establecimiento::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        $distritos = Distrito::get();
        $redes = Red::get();
        return view('establecimientos.show', compact('establecimiento', 'rutas', 'distritos', 'redes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $establecimiento = establecimiento::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        $distritos = Distrito::get();
        $redes = Red::get();
        return view('establecimientos.edit', compact('establecimiento', 'rutas', 'distritos', 'redes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateestablecimientoRequest  $request
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateestablecimientoRequest $request, $id)
    {
        $establecimiento = establecimiento::find($id);
        $establecimiento->update($request->validated());
        return redirect()->route('establecimientos.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establecimiento = establecimiento::findOrFail($id);
        try{
            $establecimiento->delete();
            return redirect()->route('establecimientos.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('establecimientos.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
