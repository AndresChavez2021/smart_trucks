<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Http\Requests\StoreZonaRequest;
use App\Http\Requests\UpdateZonaRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $zonas = Zona::select('*')->orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $zonas = $zonas->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%');
        }
        $zonas = $zonas->paginate($limit)->appends($request->all());
        return view('zonas.index', compact('zonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zonas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZonaRequest $request)
    {
        Zona::create($request->validated());
        return redirect()->route('zonas.index')->with('mensaje', 'zona Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zona = Zona::where('id', '=', $id)->firstOrFail();
        return view('zonas.show', compact('zona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zona = Zona::where('id', '=', $id)->firstOrFail();
        return view('zonas.edit', compact('zona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZonaRequest  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZonaRequest $request, $id)
    {
        $zona = Zona::find($id);
        $zona->update($request->validated());
        return redirect()->route('zonas.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zona = Zona::findOrFail($id);
        try{
            $zona->delete();
            return redirect()->route('zonas.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('zonas.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
