<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/publico.css') }}">
    <title>@yield('titulo')</title>
</head>
<body>
    <menu>
        <li>home</li>
        <li>catalogo</li>
        <li>Nosotros</li>
        <li>contactanos</li>
    </menu>
    <h1><a id="login-link" href="#">Iniciar sesión</a></h1>

    {{-- <h1><a href="{{ url('/login') }}">Registrarse</a></h1> --}}

    <div id="modal" class="modal">
        <div class="modal-content">
            <!-- Aquí coloca el contenido de tu modal -->
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
            <button id="close-modal-button">Cerrar</button>
        </div>
        <script>
            // Obtener el enlace "Iniciar Sesión" y el modal
            const loginLink = document.querySelector('#login-link');
            const modal = document.getElementById('modal');

            // Obtener el botón "Cerrar" en el modal
            const closeModalButton = document.querySelector('#close-modal-button');

            // Mostrar el modal cuando se hace clic en el enlace "Iniciar Sesión"
            loginLink.addEventListener('click', function() {
                modal.style.display = 'block';
            });

            // Cerrar el modal cuando se hace clic en el botón "Cerrar"
            closeModalButton.addEventListener('click', function() {
                modal.style.display = 'none';
            });

        </script>
    </div>
    @yield('contenido')
</body>
</html>
