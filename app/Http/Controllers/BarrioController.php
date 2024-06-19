<?php

namespace App\Http\Controllers;
use App\Models\Barrio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBarrioRequest;
use App\Models\Distrito;
class BarrioController extends Controller
{
    public function index(Request $request)
    {

        $barrios = Barrio::select('*')->orderBy('id', 'ASC');
        $limit = (isset($request->limit)) ? $request->limit : 10;
        if (isset($request->search)) {
            $barrios = $barrios->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('nombre', 'like', '%' . $request->search . '%');
        }
        $barrios = $barrios->paginate($limit)->appends($request->all());
        return view('barrios.index', compact('barrios'));
    }
    public function create()
    {
        $puntos = [];
        $distritos = Distrito::get();
        return view('barrios.create', compact('distritos','puntos'));
    }

    public function store(StoreBarrioRequest $request)
    {
        Barrio::create($request->validated());
        return redirect()->route('barrios.index')->with('mensaje', 'barrio Agregado Con Éxito');
    }
    public function show($id)
    {
        $barrios = Barrio::where('id', '=', $id)->firstOrFail();
        $puntos = json_decode($barrios->coordenada);
        $distritos = Distrito::get();
        return view('barrios.show', compact('barrios', 'puntos', 'distritos'));
    }

}
