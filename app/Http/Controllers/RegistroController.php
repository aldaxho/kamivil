<?php

namespace App\Http\Controllers;

class RegistroController extends Controller{
    public function ShowRegistro() {
        $mostrarRegistro= true;
        return view('registrar',compact('mostrarRegistro'));
    }
    
}
