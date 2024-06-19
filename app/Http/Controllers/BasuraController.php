<?php

namespace App\Http\Controllers;

use App\Models\Basura;
use App\Http\Requests\StoreBasuraRequest;
use App\Http\Requests\UpdateBasuraRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BasuraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $basuras = Basura::select('*')->orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $basuras = $basuras->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%');
        }
        $basuras = $basuras->paginate($limit)->appends($request->all());
        return view('basuras.index', compact('basuras'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basuras.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBasuraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBasuraRequest $request)
    {
        Basura::create($request->validated());
        return redirect()->route('basuras.index')->with('mensaje', 'Basura Agregada Con Éxito');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basura  $basura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basura = Basura::findOrFail($id);
        return view('basuras.show', compact('basura'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basura  $basura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $basura = Basura::findOrFail($id);
        return view('basuras.edit', compact('basura'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBasuraRequest  $request
     * @param  \App\Models\Basura  $basura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBasuraRequest $request, $id)
    {
        $basura = Basura::findOrFail($id);
        $basura->update($request->validated());
        return redirect()->route('basuras.index')->with('message', 'Se han actualizado los datos correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basura  $basura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $basura = Basura::findOrFail($id);
        try {
            $basura->delete();
            return redirect()->route('basuras.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('basuras.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
