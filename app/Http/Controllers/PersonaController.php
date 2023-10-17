<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use App\Models\Cliente;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    //
    public function index(){
        $mostrarPersona= true;
        $persona = Persona::All();
        $cliente = Cliente::All();
        return view('administrador.panelAdmin',compact('mostrarPeronsa','persona','cliente'));
    }
    public function edit($ci)
    {
        $persona = Persona::find($ci);
        dd($persona);
    if ($persona) {
        return response()->json(['persona' => $persona]);
    } else {
        // Manejo de errores si no se encuentra la persona
        //return redirect()->back()->with('error', 'No se encontró la persona con el CI proporcionado.');
        return response()->json(['error' => 'No se encontró la persona con el CI proporcionado.'], 404);
    }

    }

    public function update(Request $request, $ci)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'Nombre' => 'required',
            'CorreoElectronico' => 'required|email',
        ]);

        // Obtener la persona a actualizar
        $persona = Persona::find($ci);

        if (!$persona) {
            return redirect()->back()->with('error', 'No se encontró la persona con el CI proporcionado.');
        }

        // Actualizar los campos de la persona con los datos del formulario
        $persona->Nombre = $request->Nombre;
        $persona->CorreoElectronico = $request->CorreoElectronico;

        // Actualizar los campos adicionales si existen (cliente o personal)
        if ($persona->personal) {
            $request->validate([
                'Sexo' => 'required',
                'Dirección' => 'required',
                'Teléfono' => 'required',
                'rol' => 'required',
            ]);

            $persona->personal->Sexo = $request->Sexo;
            $persona->personal->Dirección = $request->Dirección;
            $persona->personal->Teléfono = $request->Teléfono;
            $persona->personal->cargo_id = $request->rol;
        }

        if ($persona->cliente) {
            $request->validate([
                'nit' => 'required',
            ]);

            $persona->cliente->nit = $request->nit;
        }

        // Guarda los cambios
        $persona->save();

        return redirect()->back()->with('success', 'Datos actualizados exitosamente.');
    }


    public function destroy($ci)
    {
        // Agregar lógica para eliminar la persona
        try {
            // Ejecutar consulta DELETE
            Persona::where('ci', $ci)->delete();

            return redirect()->back()->with('success', 'Personal eliminado exitosamente.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function create()
    {
        $cargos = Cargo::all();


        return view('admin.personal.create', compact('cargos'));
    }

    public function store(Request $request)
    {
        // Agregar lógica para agregar una nueva persona
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
        return view('administrador.panelAdmin');
    }
}
