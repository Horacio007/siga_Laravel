<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodigosController extends Controller
{
    public function index(){
        return view('refacciones.refacciones.codigos.codigos');
    }
}
