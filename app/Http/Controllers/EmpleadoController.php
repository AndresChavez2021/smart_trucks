<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;

class EmpleadoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-empleado|crear-empleado|editar-empleado|borrar-empleado', ['only' => 'index']);
        $this->middleware('permission:ver-empleado', ['only' => 'show']);
        $this->middleware('permission:crear-empleado', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-empleado', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-empleado', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empleados = User::select('*')->orderBy('id', 'ASC')->where('tipoe', '=', 1);
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $empleados = $empleados->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('ci', 'like', '%' . $request->search . '%')
                ->orWhere('sexo', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('domicilio', 'like', '%' . $request->search . '%')
                ->orWhere('estado', 'like', '%' . $request->search . '%');
        }
        $empleados = $empleados->paginate($limit)->appends($request->all());
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $empRole = '';
        return view('empleados.create', compact('roles', 'empRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpleadoRequest $request)
    {
        //$this->validate($request, ['roles' => 'required']);
        $user = User::create($request->validated());
        $user->assignRole($request->input('roles'));
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
        return redirect()->route('empleados.index')->with('mensaje', 'Empleado Agregado Con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = User::where('id', '=', $id)->firstOrFail();
        $roles = Role::pluck('name', 'name')->all();
        $empRole = $empleado->roles->pluck('name', 'name')->all();
        /*$image = '';
        //if ($empleado->image != null) {
            $expiresAt = new \DateTime('2023-07-15');
            $imageReference = app('firebase.storage')->getBucket()->object($empleado->carpeta);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            } else {
                $image = null;
            }
            dd($image);
        //}*/
        return view('empleados.show', compact('empleado', 'roles', 'empRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = User::where('id', '=', $id)->firstOrFail();
      //  $roles = Role::pluck('name', 'name')->all();
      //  $empRole = $empleado->roles->pluck('name', 'name')->all();
        $image = '';
        if ($empleado->image != null && $empleado->image != '') {
            $expiresAt = new \DateTime('2023-12-30');
            $imageReference = app('firebase.storage')->getBucket()->object($empleado->carpeta);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            } else {
                $image = null;
            }
            dd($image);
        }
        return view('empleados.edit', compact('empleado', 'roles', 'empRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoRequest $request, $id)
    {
        $this->validate($request, ['roles' => 'required']);
        $empleado = User::find($id);
        $antImg = $empleado->carpeta;
        $empleado->update($request->validated());
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $empleado->assignRole($request->input('roles'));
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
            $empleado->carpeta = $firebase_storage_path . $file;
            //URL
            $expiresAt = new \DateTime('2023-07-15');
            $imageReference = app('firebase.storage')->getBucket()->object($empleado->carpeta);
            if ($imageReference->exists()) {
                $empleado->image = $imageReference->signedUrl($expiresAt);
            }
            $empleado->save();
        }
        return redirect()->route('empleados.index')->with('message', 'Se ha actualizado los datos correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = User::findOrFail($id);
        try {
            $carpeta = $empleado->carpeta;
            $empleado->delete();
            app('firebase.storage')->getBucket()->object($carpeta)->delete();
            return redirect()->route('empleados.index')->with('message', 'Se han borrado los datos correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('empleados.index')->with('danger', 'Datos relacionados con otras tablas, imposible borrar datos.');
        }
    }
}
