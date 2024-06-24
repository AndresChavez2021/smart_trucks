<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reclamo;
use App\Models\Basura;
use App\Models\Recepcion;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $TipoC = auth()->user()->tipoc;
            $TipoE = auth()->user()->tipoe;
            if ($TipoC == 1) {
                return view('inicio');
            } else {
                if ($TipoE == 1) {

                    $totalUsuarios = User::count();
                    $totalClientes = User::where('tipoc', 1)->count();
                    $totalEmpleados = User::where('tipoe', 1)->count();
                   // $reclamos = Reclamo::select('coordenada')->get();

                   $data = DB::table('recepcions as r')
                    ->select('r.id_basura', DB::raw('SUM(r.cantidad) as total_cantidad'), 'b.nombre as nombre_basura')
                    ->join('basuras as b', 'r.id_basura', '=', 'b.id')
                    ->whereYear('r.fechaHora', date('Y'))
                    ->groupBy('r.id_basura', 'b.nombre')
                    ->orderBy('r.id_basura')
                    ->get();
                 //dd($data);
                    
            
                 $chartData = [];
                 foreach ($data as $item) {
                     $chartData[] = [$item->nombre_basura, (float) $item->total_cantidad];
                 }
             
                 // Convertir a JSON
                 $jsonData = json_encode($chartData);
                //dd($jsonData);    
                    return view('home.index', [
                        'totalUsuarios'=> $totalUsuarios, 
                        'totalClientes'=> $totalClientes,
                        'totalEmpleados'=> $totalEmpleados,
                        'jsonData'=>$jsonData,
                       
                        ]);

                }
            }
        }
        /*if(auth()->user()){
            return view('home.index');
        }*/
        return view('inicio');
    }
}
