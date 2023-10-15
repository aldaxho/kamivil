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
        @if (Auth::check())
        <!-- Mostrar botón de Cerrar sesión si el usuario ha iniciado sesión -->
            @if (Auth::user()->hasRole('Administrador'))
                <!-- Mostrar opciones para el rol "administrador" -->
                <li><a href="#">Opción para administradores</a></li>
                <li><a href="{{ route('admin') }}">Panel de Administrador</a></li>


            @endif
            @if (Auth::user()->hasRole('Atencion al cliente'))
                <!-- Mostrar opciones para el rol "otro_rol" -->
                <li><a href="#">Opción para otro rol</a></li>
                <li><a href="">Panel Personal</a></li>
            @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
        <li>compras realizadas</li>
        <li><a href="">Cambiar Contraseña</a></li>
        @else
        <!-- Mostrar botones de Iniciar sesión y Crear cuenta si el usuario no ha iniciado sesión -->
        <h1><a id="login-link" href="#">Iniciar sesión</a></h1>
        <h1><a id="register-link" href="#">Crear Cuenta</a></h1>
        @endif

    </menu>

    @if (Session::has('success'))
    <div style="color: green">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div style="color: red">{{ Session::get('error') }}</div>
    @endif


    <div id="login-modal" class="modal">
        <div class="modal-content">
            <!-- Contenido del modal de inicio de sesión -->
            <h2>Iniciar Sesión</h2>
            @if (Session::has('success'))
            <div style="color: green">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
            <div style="color: red">{{ Session::get('error') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="CorreoElectronico">Correo Electrónico:</label>
                <input type="text" name="CorreoElectronico" id="CorreoElectronico-login" value="{{ old('CorreoElectronico') }}" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="password" id="contraseña" required>
                <button type="button" id="ver-contraseña-login">Ver Contraseña</button>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <button id="close-login-modal-button">Cerrar</button>
        </div>
    </div>

    <div id="register-modal" class="modal">
        <div class="modal-content">
            <!-- Contenido del modal de registro -->
            <h2>Registrarse</h2>
            @if (Session::has('registration_success'))
                <div style="color: green">{{ Session::get('registration_success') }}</div>
            @endif
            @if (Session::has('registration_error'))
                <div style="color: red">{{ Session::get('registration_error') }}</div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="ci">Cédula de Identidad:</label>
                <input type="text" name="ci" id="ci" value="{{ old('ci') }}" required>
                <label for="Nombre">Nombre:</label>
                <input type="text" name="Nombre" id="Nombre" value="{{ old('Nombre') }}" required>
                <label for="CorreoElectronico">Correo Electrónico:</label>
                <input type="text" name="CorreoElectronico" id="CorreoElectronico-registro" value="{{ old('CorreoElectronico') }}" required>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
                <button type="button" id="ver-contraseña-registro">Ver Contraseña</button>
                <button type="submit">Registrarse</button>
            </form>
            <button id="close-register-modal-button">Cerrar</button>
        </div>
    </div>

    @yield('contenido')

    <script>
        const loginLink = document.querySelector('#login-link');
        const loginModal = document.getElementById('login-modal');
        const closeLoginModalButton = document.querySelector('#close-login-modal-button');
        const registerLink = document.querySelector('#register-link');
        const registerModal = document.getElementById('register-modal');
        const closeRegisterModalButton = document.querySelector('#close-register-modal-button');

        loginLink.addEventListener('click', function() {
            loginModal.style.display = 'block';
        });

        closeLoginModalButton.addEventListener('click', function() {
            loginModal.style.display = 'none';
        });

        registerLink.addEventListener('click', function() {
            registerModal.style.display = 'block';
        });

        closeRegisterModalButton.addEventListener('click', function() {
            registerModal.style.display = 'none';
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            const contraseñaInput = document.getElementById("contraseña");
            const verContraseñaButton = document.getElementById("ver-contraseña-login");

            verContraseñaButton.addEventListener("click", function () {
                if (contraseñaInput.type === "password") {
                    contraseñaInput.type = "text"; // Mostrar la contraseña
                } else {
                    contraseñaInput.type = "password"; // Ocultar la contraseña
                }
            });
        });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const contraseñaInput = document.getElementById("password");
                const verContraseñaButton = document.getElementById("ver-contraseña-registro");

                verContraseñaButton.addEventListener("click", function () {
                    if (contraseñaInput.type === "password") {
                        contraseñaInput.type = "text"; // Mostrar la contraseña
                    } else {
                        contraseñaInput.type = "password"; // Ocultar la contraseña
                    }
                });
            });
            </script>
</body>
</html>
