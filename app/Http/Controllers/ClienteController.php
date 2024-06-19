<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Ruta;

class ClienteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-cliente|crear-cliente|editar-cliente|borrar-cliente', ['only' => 'index']);
        $this->middleware('permission:ver-cliente', ['only' => 'show']);
        $this->middleware('permission:crear-cliente', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-cliente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-cliente', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = User::select('*')->orderBy('id', 'ASC')->where('tipoc', '=', 1);
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $clientes = $clientes->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('ci', 'like', '%' . $request->search . '%')
                ->orWhere('sexo', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        }
        $clientes = $clientes->paginate($limit)->appends($request->all());
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rutas = Ruta::get();
        return view('clientes.create', compact('rutas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image'); //image file from frontend
            $firebase_storage_path = 'Empleados/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = time() . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                // Se elimina el archivo del directorio local de Laravel
                unlink($localfolder . $file);
            }
            $user->carpeta = $firebase_storage_path . $file;
            //URL
            $expiresAt = new \DateTime('2023-07-15');
            $imageReference = app('firebase.storage')->getBucket()->object($user->carpeta);
            if ($imageReference->exists()) {
                $user->image = $imageReference->signedUrl($expiresAt);
            }
            $user->save();
        }
        return redirect()->route('clientes.index')->with('mensaje', 'cliente Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = User::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        return view('clientes.show', compact('cliente', 'rutas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = User::where('id', '=', $id)->firstOrFail();
        $rutas = Ruta::get();
        return view('clientes.edit', compact('cliente', 'rutas'));
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
        $cliente = User::find($id);
        $antImg = $cliente->image;
        $cliente->update($request->validated());
        if ($request->hasFile('image')) {
            if ($antImg != null) {
                app('firebase.storage')->getBucket()->object($antImg)->delete();
            }
            $image = $request->file('image'); //image file from frontend
            $firebase_storage_path = 'Empleados/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = time() . '.' . $extension;

            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                // Se elimina el archivo del directorio local de Laravel
                unlink($localfolder . $file);
            }
            $cliente->carpeta = $firebase_storage_path . $file;
            //URL
            $expiresAt = new \DateTime('2023-07-15');
            $imageReference = app('firebase.storage')->getBucket()->object($cliente->carpeta);
            if ($imageReference->exists()) {
                $cliente->image = $imageReference->signedUrl($expiresAt);
            }
            $cliente->save();
        }
        return redirect()->route('clientes.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = User::findOrFail($id);
        try {
            $image = $cliente->image;
            $cliente->delete();
            app('firebase.storage')->getBucket()->object($image)->delete();
            return redirect()->route('clientes.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('clientes.index')->with('danger', 'Datos relacionados, imposible borrar dato.');
        }
    }
}
