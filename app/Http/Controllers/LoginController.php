<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Usuarios;
use Illuminate\Http\Request;
date_default_timezone_set('America/Mexico_City');

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->usr) && isset($request->pwd)) {
            session_start();
            $user = preg_replace('([^A-Za-z0-9])', '', $request->usr);
            $pass = preg_replace('([^A-Za-z0-9])', '', $request->pwd);
            $e = Usuarios::where('usuario', $user)
                            ->where('pswd', md5($pass))
                            ->first();
            if ($e == null) {
                return redirect()->route('login')->with('warning','Usuario o Contraseña Invalido.');
            } else {
                $_SESSION['user'] = $user;
                $_SESSION['pasword'] = $pass;
                $_SESSION['tipo'] = $e->tipo;
                $_SESSION['timeout'] = time();
                $tipo = $e->tipo;

                $f = date("Y-m-d");
                $h = date("H:i:s");
                
                $l = new Login();
                $l->nombre = $user;
                $l->puesto = $e->tipo;
                $l->fecha = $f;
                $l->hora = $h;
                $l->save();

                return view('menu.menu', compact(['user', 'tipo']));

            }
        } else {
            return redirect()->route('login')->with('warning','Ingresa Usuario o Contraseña.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.login');
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
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
