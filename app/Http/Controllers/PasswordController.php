<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()) {
            $TipoC = auth()->user()->tipoc;
            $TipoE = auth()->user()->tipoe;
            if ($TipoC == 1) {
                return view('inicio')->with('message', 'Se ha actualizado los datos correctamente.');
            } else {
                if ($TipoE == 1) {
                    return view('home.index')->with('message', 'Se ha actualizado los datos correctamente.');
                }
            }
        }
        return view('inicio')->with('message', 'Se ha actualizado los datos correctamente.');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perfil = User::where('id', '=', $id)->firstOrFail();
        if ($perfil->tipoc == 1) {
            return view('perfil.editPassCli', compact('perfil'));
        } else {
            return view('perfil.editPass', compact('perfil'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordRequest $request, $id)
    {
        $perfil = User::find($id);
        $perfil->update($request->validated());
        return redirect()->route('password.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
