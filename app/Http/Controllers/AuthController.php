<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Persona;
use App\Models\Personal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //


    public function login(Request $request)
{
    // Busca al usuario por correo electrónico y contraseña
    $user = Persona::where('CorreoElectronico', $request->CorreoElectronico)
                  ->where('password', $request->password)
                  ->first();

    if ($user) {
        // Comprueba si el 'ci' del usuario existe en la tabla 'Personal'
        $personal = Personal::where('ci_personal', $user->ci)->first();
        if ($personal) {
            // Usuario es 'Personal'
            Auth::login($user);
            return view('welcome');
        }
            // Usuario es 'Cliente'
            Auth::login($user);
            return view('welcome');
        
    } else {
        // La autenticación falló
        Session::flash('error', 'Credenciales incorrectas');
        return back()->withInput();
    }
}

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
