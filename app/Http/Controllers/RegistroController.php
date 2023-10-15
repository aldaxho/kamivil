<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller{
    public function ShowRegistro() {
        $mostrarRegistro= true;
        return view('registrar',compact('mostrarRegistro'));
    }

    public function register(Request $request)
    {
        // Validar y crear un nuevo usuario en la base de datos
        $request->validate([
            'ci' => 'required|unique:persona',
            'Nombre' => 'required',
            'CorreoElectronico' => 'required|email|unique:persona',
            'password' => 'required|min:6',
        ]);

        $persona = new Persona;
        $persona->ci = $request->ci;
        $persona->Nombre = $request->Nombre;
        $persona->CorreoElectronico = $request->CorreoElectronico;
        $persona->password = Hash::make($request->password);
        $persona->save();

        // Autenticar al usuario después del registro
        Auth::login($persona);

        return view('welcome'); // Cambia la redirección según tus necesidades
    }

}
