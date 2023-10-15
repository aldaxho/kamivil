<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('administrador.panelAdmin'); // Ajusta el nombre de la vista según tu estructura de carpetas
    }
}
