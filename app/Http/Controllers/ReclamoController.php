<?php

namespace App\Http\Controllers;

use App\Models\Reclamo;
use App\Http\Requests\StoreReclamoRequest;
use App\Http\Requests\UpdateReclamoRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReclamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reclamos = DB::table('reclamos')
            ->join('users', 'reclamos.id_cliente', '=', 'users.id')
            ->select(
                'reclamos.id',
                'reclamos.descripcion',
                'reclamos.fechaHora',
                'users.name AS cliente'
            )
            ->orderBy('reclamos.id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $reclamos = $reclamos->where('reclamos.id', 'like', '%' . $request->search . '%')
                ->orWhere('reclamos.descripcion', 'like', '%' . $request->search . '%')
                ->orWhere('reclamos.fechaHora', 'like', '%' . $request->search . '%')
                ->orWhere('users.name', 'like', '%' . $request->search . '%');
        }
        $reclamos = $reclamos->paginate($limit)->appends($request->all());
        return view('reclamos.index', compact('reclamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::where('tipoc', 1)->get();
        return view('reclamos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReclamoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReclamoRequest $request)
    {
        reclamo::create($request->validated());
        return redirect()->route('reclamos.index')->with('mensaje', 'reclamo Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reclamo  $reclamo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reclamo = reclamo::where('id', '=', $id)->firstOrFail();
        $clientes = User::where('tipoc', 1)->get();
        return view('reclamos.show', compact('reclamo', 'clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reclamo  $reclamo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reclamo = reclamo::where('id', '=', $id)->firstOrFail();
        $clientes = User::where('tipoc', 1)->get();
        return view('reclamos.edit', compact('reclamo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReclamoRequest  $request
     * @param  \App\Models\Reclamo  $reclamo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReclamoRequest $request, $id)
    {
        $reclamo = reclamo::find($id);
        $reclamo->update($request->validated());
        return redirect()->route('reclamos.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reclamo  $reclamo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reclamo = reclamo::findOrFail($id);
        try {
            $reclamo->delete();
            return redirect()->route('reclamos.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('reclamos.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
