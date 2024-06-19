<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                    return view('home.index');
                }
            }
        }
        /*if(auth()->user()){
            return view('home.index');
        }*/
        return view('inicio');
    }
}
