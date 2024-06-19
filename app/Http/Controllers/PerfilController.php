<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class PerfilController extends Controller
{
    public function index(Request $request)
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

    public function edit($id)
    {
        $perfil = User::where('id', '=', $id)->firstOrFail();
        if($perfil->tipoe == 1){
            return view('perfil.edit', compact('perfil'));
        }else{
            return view('perfil.editCli', compact('perfil'));
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $perfil = User::find($id);
        $perfil->update($request->validated());
        return redirect()->route('perfil.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }
}
