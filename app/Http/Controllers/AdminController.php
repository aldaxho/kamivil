<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\Personal;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $persona = Persona::All();
        $cantidadUsuarios = Persona::count(); // Esto recuperará la cantidad de registros en la tabla de usuarios
        $personal = Personal::All();
        $cargo = Cargo::All();
        $cliente = Cliente::All();
        return view('administrador.panelAdmin',compact('persona','cliente','personal','cargo','cantidadUsuarios'));  // Ajusta el nombre de la vista según tu estructura de carpetas
    }
}
