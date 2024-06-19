<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Http\Requests\StoreCamionRequest;
use App\Http\Requests\UpdateCamionRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $camiones = Camion::orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;

        if (isset($request->search)) {
            $camiones = $camiones->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%')
                ->orWhere('placa', 'like', '%' . $request->search . '%')
                ->orWhere('capacidad_personal', 'like', '%' . $request->search . '%')
                ->orWhere('capacidad_carga', 'like', '%' . $request->search . '%');
        }

        $camiones = $camiones->paginate($limit)->appends($request->all());
        return view('camiones.index', compact('camiones'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('camiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCamionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCamionRequest $request)
    {
        $camion =  Camion::create($request->validated());
        if ($request->hasFile('image')) {
            $image = $request->file('image'); //image file from frontend
            $firebase_storage_path = 'Vehiculos/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = time() . '.' . $extension;
            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                // Se elimina el archivo del directorio local de Laravel
                unlink($localfolder . $file);
            }
            $camion->carpeta = $firebase_storage_path . $file;
            //URL
            $expiresAt = new \DateTime('2023-12-30');
            $imageReference = app('firebase.storage')->getBucket()->object($camion->carpeta);
            if ($imageReference->exists()) {
                $camion->image = $imageReference->signedUrl($expiresAt);
            }
            $camion->save();
        }
        return redirect()->route('camiones.index')->with('mensaje', 'Camión agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $camion = Camion::findOrFail($id);
        return view('camiones.show', compact('camion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $camion = Camion::findOrFail($id);

    /*    $camion = Camion::where('id', '=', $id)->firstOrFail();
        $image = '';
        if ($camion->image != null && $camion->image != '') {
            $expiresAt = new \DateTime('2023-12-30');
            $imageReference = app('firebase.storage')->getBucket()->object($camion->carpeta);
            if ($imageReference->exists()) {
                $image = $imageReference->signedUrl($expiresAt);
            } else {
                $image = null;
            }
            dd($image);
        }*/

        return view('camiones.edit', compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCamionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCamionRequest $request, $id)
    {
        $camion = Camion::findOrFail($id);
        $antImg = $camion->carpeta;
        $camion->update($request->validated());
        if ($request->hasFile('image')) {
            if ($antImg != null) {
                app('firebase.storage')->getBucket()->object($antImg)->delete();
            }
            $image = $request->file('image'); //image file from frontend
            $firebase_storage_path = 'Vehiculos/';
            $localfolder = public_path('firebase-temp-uploads') . '/';
            $extension = $image->getClientOriginalExtension();
            $file = time() . '.' . $extension;

            if ($image->move($localfolder, $file)) {
                $uploadedfile = fopen($localfolder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
                // Se elimina el archivo del directorio local de Laravel
                unlink($localfolder . $file);
            }
            $camion->carpeta = $firebase_storage_path . $file;
            //URL
            $expiresAt = new \DateTime('2023-12-30');
            $imageReference = app('firebase.storage')->getBucket()->object($camion->carpeta);
            if ($imageReference->exists()) {
                $camion->image = $imageReference->signedUrl($expiresAt);
            }
            $camion->save();
        }
        return redirect()->route('camiones.index')->with('message', 'Los datos se han actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camion = Camion::findOrFail($id);
        try {
            $carpeta = $camion->carpeta;
            $camion->delete();
            app('firebase.storage')->getBucket()->object($carpeta)->delete();
            return redirect()->route('camiones.index')->with('message', 'Los datos se han borrado correctamente.');
        } catch (QueryException $e) {
            return redirect()->route('camiones.index')->with('message', 'Error al borrar los datos.');
        }
    }
}
