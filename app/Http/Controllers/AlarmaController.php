<?php

namespace App\Http\Controllers;

use App\Models\Alarma;
use App\Http\Requests\StoreAlarmaRequest;
use App\Http\Requests\UpdateAlarmaRequest;
use App\Models\User;
use Database\Seeders\AlarmaSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlarmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alarmas = DB::table('alarmas')
            ->join('users', 'alarmas.id_cliente', '=', 'users.id')
            ->select(
                'alarmas.id',
                'alarmas.nombre',
                'alarmas.fechaHora',
                'alarmas.radio',
                'alarmas.estado',
                'users.name AS cliente'
            )
            ->orderBy('alarmas.id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $alarmas = $alarmas->where('alarmas.id', 'like', '%' . $request->search . '%')
                ->orWhere('alarmas.nombre', 'like', '%' . $request->search . '%')
                ->orWhere('alarmas.fechaHora', 'like', '%' . $request->search . '%')
                ->orWhere('alarmas.radio', 'like', '%' . $request->search . '%')
                ->orWhere('alarmas.estado', 'like', '%' . $request->search . '%')
                ->orWhere('users.name', 'like', '%' . $request->search . '%');
        }
        $alarmas = $alarmas->paginate($limit)->appends($request->all());
        return view('alarmas.index', compact('alarmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = User::where('tipoc', 1)->get();
        return view('alarmas.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlarmaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlarmaRequest $request)
    {
        Alarma::create($request->validated());
        return redirect()->route('alarmas.index')->with('mensaje', 'alarma Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alarma  $alarma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alarma = alarma::where('id', '=', $id)->firstOrFail();
        $clientes = User::where('tipoc', 1)->get();
        return view('alarmas.show', compact('alarma', 'clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alarma  $alarma
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alarma = alarma::where('id', '=', $id)->firstOrFail();
        $clientes = User::where('tipoc', 1)->get();
        return view('alarmas.edit', compact('alarma', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlarmaRequest  $request
     * @param  \App\Models\Alarma  $alarma
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlarmaRequest $request, $id)
    {
        $alarma = Alarma::find($id);
        $alarma->update($request->validated());
        return redirect()->route('alarmas.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alarma  $alarma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alarma = Alarma::findOrFail($id);
        try {
            $alarma->delete();
            return redirect()->route('alarmas.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('alarmas.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
