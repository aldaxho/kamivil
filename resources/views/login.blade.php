@extends('layoutS.publico.plantilla')

@section('titulo','Login')
@section('contenido')
<div>
    <h2>Iniciar Sesión</h2>
    @if (Session::has('success'))
        <div style="color: green">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div style="color: red">{{ Session::get('error') }}</div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="CorreoElectronico">Correo Electronicio:</label>
        <input type="text" name="CorreoElectronico" id="CorreoElectronico" value="{{ old('CorreoElectronico') }}" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="password" id="contraseña" required>
        <button type="button" id="ver-contraseña">Ver Contraseña</button>
        <button type="submit">Iniciar Sesión</button>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const contraseñaInput = document.getElementById("contraseña");
        const verContraseñaButton = document.getElementById("ver-contraseña");

        verContraseñaButton.addEventListener("click", function () {
            if (contraseñaInput.type === "password") {
                contraseñaInput.type = "text"; // Mostrar la contraseña
            } else {
                contraseñaInput.type = "password"; // Ocultar la contraseña
            }
        });
    });
    </script>
    </form>


</div>
