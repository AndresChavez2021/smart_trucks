<?php

namespace App\Http\Controllers;

use App\Models\Red;
use App\Http\Requests\StoreRedRequest;
use App\Http\Requests\UpdateRedRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redes = red::select('*')->orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $redes = $redes->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%');
        }
        $redes = $redes->paginate($limit)->appends($request->all());
        return view('redes.index', compact('redes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('redes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreredRequest $request)
    {
        red::create($request->validated());
        return redirect()->route('redes.index')->with('mensaje', 'red Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $red = red::where('id', '=', $id)->firstOrFail();
        return view('redes.show', compact('red'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $red = red::where('id', '=', $id)->firstOrFail();
        return view('redes.edit', compact('red'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRedRequest  $request
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateredRequest $request, $id)
    {
        $red = red::find($id);
        $red->update($request->validated());
        return redirect()->route('redes.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Red  $red
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $red = red::findOrFail($id);
        try{
            $red->delete();
            return redirect()->route('redes.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('redes.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
