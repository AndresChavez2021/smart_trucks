<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-usuario|editar-usuario|borrar-usuario', ['only' => 'index']);
        $this->middleware('permission:ver-usuario', ['only' => 'show']);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-usuario', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::select('*')->orderBy('id','ASC');
        $limit = (isset($request->limit)) ? $request->limit:10;
        if(isset($request->search)){
            $users = $users->where('id','like','%'.$request->search.'%')
            ->orWhere('name','like','%'.$request->search.'%')
            ->orWhere('apellidos','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->orWhere('ci','like','%'.$request->search.'%')
            ->orWhere('sexo','like','%'.$request->search.'%')
            ->orWhere('phone','like','%'.$request->search.'%')
            ->orWhere('domicilio','like','%'.$request->search.'%')
            ->orWhere('estado','like','%'.$request->search.'%');
        }
        $users = $users->paginate($limit)->appends($request->all());
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with('mensaje', 'user Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update($request->validated());
        return redirect()->route('users.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try{
            $user->delete();
            return redirect()->route('users.index')->with('message', 'Se han borrado los datos correctamente.');
        }catch(QueryException $e){
            return redirect()->route('users.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
