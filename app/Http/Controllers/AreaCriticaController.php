<?php

namespace App\Http\Controllers;

use App\Models\AreaCritica;
use App\Http\Requests\StoreAreaCriticaRequest;
use App\Http\Requests\UpdateAreaCriticaRequest;
use App\Models\Ruta;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AreaCriticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areasCriticas = AreaCritica::select('*')->orderBy('id','ASC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $areasCriticas = $areasCriticas->where('id','like','%'.$request->search.'%')
            ->orWhere('latitud','like','%'.$request->search.'%')
            ->orWhere('longitud','like','%'.$request->search.'%')
            ->orWhere('radio','like','%'.$request->search.'%')
            ->orWhere('id_ruta','like','%'.$request->search.'%');
        }
        $areasCriticas = $areasCriticas->paginate($limit)->appends($request->all());
        return view('areasCriticas.index', compact('areasCriticas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutas = Ruta::get();
        return view('areasCriticas.create', compact('rutas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAreaCriticaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaCriticaRequest $request)
    {
        AreaCritica::create($request->validated());
        return redirect()->route('areasCriticas.index')->with('mensaje', 'areaCritica Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaCritica  $areaCritica
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $areaCritica = AreaCritica::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        return view('areasCriticas.show', compact('areaCritica', 'rutas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaCritica  $areaCritica
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areaCritica = AreaCritica::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        return view('areasCriticas.edit', compact('areaCritica', 'rutas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAreaCriticaRequest  $request
     * @param  \App\Models\AreaCritica  $areaCritica
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaCriticaRequest $request, $id)
    {
        $areaCritica = AreaCritica::find($id);
        $areaCritica->update($request->validated());
        return redirect()->route('areasCriticas.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaCritica  $areaCritica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $areaCritica = AreaCritica::findOrFail($id);
        try{
            $areaCritica->delete();
            return redirect()->route('areasCriticas.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('areasCriticas.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
