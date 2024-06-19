<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Http\Requests\StoreHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $horarios = Horario::select('*')->orderBy('id','ASC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $horarios = $horarios->where('id','like','%'.$request->search.'%')
            ->orWhere('dia_semana','like','%'.$request->search.'%')
            ->orWhere('hora_inicio','like','%'.$request->search.'%')
            ->orWhere('hora_fin','like','%'.$request->search.'%');
        }
        $horarios = $horarios->paginate($limit)->appends($request->all());
        return view('horarios.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diasDeLaSemana = [];
        return view('horarios.create', compact('diasDeLaSemana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHorarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHorarioRequest $request)
    {
        $request->validated();
        Horario::create([
            'dia_semana' => implode(', ', $request->dia_semana),
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);
        return redirect()->route('horarios.index')->with('mensaje', 'horario Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horario = Horario::where('id', '=', $id)->firstOrFail();
        $diasDeLaSemana = explode(', ', $horario->dia_semana);
        return view('horarios.show', compact('horario', 'diasDeLaSemana'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::where('id', '=', $id)->firstOrFail();
        $diasDeLaSemana = explode(', ', $horario->dia_semana);
        return view('horarios.edit', compact('horario', 'diasDeLaSemana'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHorarioRequest  $request
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHorarioRequest $request, $id)
    {
        $horario = Horario::findOrFail($id);
        $request->validated();
        $horario->dia_semana = implode(', ', $request->dia_semana);
        $horario->hora_inicio = $request->hora_inicio;
        $horario->hora_fin = $request->hora_fin;
        $horario->save();
        return redirect()->route('horarios.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        try{
            $horario->delete();
            return redirect()->route('horarios.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('horarios.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
