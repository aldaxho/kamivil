@extends('layoutS.administrador.plantillaAdmin')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('titulo','PanelAdmin')

@section('contenido')
<div class="admin-panel">
    <button id="toggle-sidebar">☰</button>
    <aside class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Logo de la empresa">
            <h1>Admin Panel</h1>
        </div>
        <ul class="menu">
            <li><a href="#" data-section="pagina-principal">Inicio</a></li>
            <li><a href="#" data-section="user-list-container">Usuarios</a></li>
            <li><a href="#" data-section="pagina-personal">Mi personal</a></li>
            <li><a href="#" data-section="pagina-productos">Productos</a></li>
            <li><a href="#" data-section="pagina-reportes">Estadísticas</a></li>
            <li><a href="#" data-section="pagina-spam">enviar mensaje de correo de cualquier anuncio</a></li>
            <li><a href="#" data-section="pagina-configuracion">Configuración</a></li>
        </ul>
    </aside>
    <main class="content">
        <header class="header">
            <h2>Bienvenido, Administrador</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </header>
        <div class="dashboard">
            <!-- Contenido del panel de administrador -->
            <div id="pagina-principal" style="display: none; max-height: 400px;">
                <h1>pagina principal,aqui vendra  datos generales del sistema </h1>

                <div class="cuadrado">
                    <h1 >Cantidad de Usuarios Registrados</h1>
                    <p>{{ $cantidadUsuarios }}</p>
                </div>

            </div>

            <div id="user-list-container" style="display: none; overflow: auto; max-height: 400px;">
                <!-- Aquí se mostrará la lista de usuarios cuando se hace clic en "Usuarios" -->
                <h1 style="display: inline-block width: 50px;
                text-decoration: none;">Lista de Usuarios</h1>
                <a href="#" class="btn btn-primary" id="agregar-persona">Añadir Persona</a>

                <div id="pagina-añadir-persona" class="modal" >
                    <div class="modal-content">
                        <!-- Contenido del modal de registro -->
                        <h2>Añadir Persona Nueva</h2>
                        @if (Session::has('registration_success'))
                            <div style="color: green">{{ Session::get('registration_success') }}</div>
                        @endif
                        @if (Session::has('registration_error'))
                            <div style="color: red">{{ Session::get('registration_error') }}</div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label for="ci">Cédula de Identidad:</label>
                            <input type="text" name="ci" id="ci_registro" value="{{ old('ci') }}" required>
                            <label for="Nombre">Nombre:</label>
                            <input type="text" name="Nombre" id="Nombre_registro" value="{{ old('Nombre') }}" required>
                            <label for="CorreoElectronico">Correo Electrónico:</label>
                            <input type="text" name="CorreoElectronico" id="CorreoElectronico_registro" value="{{ old('CorreoElectronico') }}" required>
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password_registro" required>
                            <button type="button" id="ver-contraseña-registro">Ver Contraseña</button>
                            <button type="submit">Agregar Persona</button>
                        </form>
                        <button id="close-register-modal-button">Cerrar</button>
                    </div>
                </div>

                <table >
                    <thead>
                        <tr>
                            <th>CI</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Correo Electronico</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Nit</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($persona)
                            @foreach($persona as $person)
                                <tr>
                                    <td>{{ $person->ci }}</td>
                                    <td>{{ $person->Nombre }}</td>
                                    <td>{{ $person->personal->Sexo ?? ''}}</td>
                                    <td>{{ $person->CorreoElectronico }}</td>
                                    <td>{{ $person->personal->Dirección ?? ''}}</td>
                                    <td>{{ $person->personal->Teléfono ?? ''}}</td>
                                    <td>{{ $person->cliente->nit ?? ''}}</td>
                                    <td>{{ $person->personal->cargo->rol ?? ''}}</td>
                                    <td>
                                        <a id="editar-link-{{ $person->ci }}" href="#">editar</a>
                                        <div id="editar-modal-{{ $person->ci }}" class="modal">
                                            <div class="modal-content">
                                                <!-- Contenido del modal de inicio de sesión -->
                                                 <!-- Título del formulario -->
                                                    <h2>Editar Usuario</h2>

                                                    <!-- Formulario de edición -->
                                                    <form method="POST" action="{{ route('personal.update', $person->ci) }}">
                                                        @csrf
                                                        @method('PUT')


                                                        <!-- Campo de nombre -->
                                                        <div class="form-group">
                                                            <label for="Nombre">Nombre:</label>
                                                            <input type="text" name="Nombre" id="Nombre" value="{{ $person->Nombre }}">
                                                        </div>

                                                        <!-- Campo de correo electrónico -->
                                                        <div class="form-group">
                                                            <label for="CorreoElectronico">Correo Electrónico:</label>
                                                            <input type="text" name="CorreoElectronico" id="CorreoElectronico" value="{{ $person->CorreoElectronico }}">
                                                        </div>

                                                        <!-- Otros campos para la edición, como Sexo, Dirección, Teléfono, etc. -->
                                                        @if ($person->personal && $person->personal->Sexo !== null)
                                                            <div class="form-group">
                                                                <label for="Sexo">Sexo:</label>
                                                                <input type="text" name="Sexo" id="Sexo" value="{{ $person->personal->Sexo }}">
                                                            </div>
                                                        @endif
                                                        @if ($person->personal && $person->personal->Dirección !== null)
                                                        <div class="form-group">
                                                            <label for="Dirección">Dirección:</label>
                                                            <input type="text" name="Dirección" id="Dirección" value="{{ $person->personal->Dirección }}">
                                                        </div>
                                                        @endif
                                                        @if ($person->personal && $person->personal->Teléfono !== null)
                                                        <div class="form-group">
                                                            <label for="Teléfono">Teléfono:</label>
                                                            <input type="text" name="Teléfono" id="Teléfono" value="{{ $person->personal->Teléfono }}">
                                                        </div>
                                                        @endif
                                                        @if ($person->cliente && $person->cliente->nit !== null)
                                                        <div class="form-group">
                                                            <label for="nit">Nit:</label>
                                                            <input type="text" name="nit" id="nit" value="{{ $person->cliente->nit }}">
                                                        </div>
                                                        @endif
                                                        @if ($person->personal && $person->personal->cargo->rol !== null)
                                                       <!-- Campo de Rol -->
                                                        <div class="form-group">
                                                            <label for="rol">Rol:</label>
                                                            <select name="rol" id="rol">
                                                                <option value="">Selecciona un rol</option> <!-- Opción por defecto para deseleccionar el rol -->
                                                                @foreach($cargo as $rol)
                                                                    <option value="{{ $rol->id }}" @if ($person->personal && $person->personal->cargo->id === $rol->id) selected @endif>{{ $rol->rol }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        @endif

                                                        <!-- Agrega campos adicionales según tus necesidades -->

                                                        <!-- Botón para enviar el formulario de edición -->
                                                        <button type="submit">Guardar Cambios</button>
                                                    </form>

                                                <button id="close-editar-modal-button-{{ $person->ci }}">Cerrar</button>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('personal.destroy', $person->ci) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div id="pagina-personal" style="display: none;overflow: auto; max-height: 400px;">
                <h1>aqui la lista del personal crud general</h1>
            </div>
            <div id="pagina-productos" style="display: none;overflow: auto; max-height: 400px;">
                <h1>aqui la lista de productos con crud general</h1>
            </div>
            <div id="pagina-reportes" style="display: none;overflow: auto; max-height: 400px;">
                <h1>pagina de reporte de inventario de costo y ganancias</h1>
            </div>
            <div id="pagina-spam" style="display: none;overflow: auto; max-height: 400px;">
                <h1>aqui se enviara cualquier mensaje al cliente tanto como anuncio o cambio de contraseñas</h1>
            </div>
            <div id="pagina-configuracion" style="display: none; max-height: 400px;">
                <h1>pagina donde ira algunas modificaciones al sistema, como ser el logo y otras cosas mas </h1>
            </div>
        </div>
    </main>
</div>
<script>
   @foreach($persona as $person)
    const editarLink{{ $person->ci }} = document.querySelector('#editar-link-{{ $person->ci }}');
    const editarModal{{ $person->ci }} = document.getElementById('editar-modal-{{ $person->ci }}');
    const closeEditarModalButton{{ $person->ci }} = document.querySelector('#close-editar-modal-button-{{ $person->ci }}');

    editarLink{{ $person->ci }}.addEventListener('click', function() {
        editarModal{{ $person->ci }}.style.display = 'block';
    });

    closeEditarModalButton{{ $person->ci }}.addEventListener('click', function() {
        editarModal{{ $person->ci }}.style.display = 'none';
    });
   @endforeach

</script>
<script>
    // JavaScript
    const registerLink = document.querySelector('#agregar-persona');
    const registerModal = document.getElementById('pagina-añadir-persona');
    const closeRegisterModalButton = document.querySelector('#close-register-modal-button');


    registerLink.addEventListener('click', function() {
        registerModal.style.display = 'block';
    });

    closeRegisterModalButton.addEventListener('click', function() {
        registerModal.style.display = 'none';
    });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("toggle-sidebar");
        const sidebar = document.querySelector(".sidebar");
        const sections = document.querySelectorAll(".dashboard > div");

        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("hidden");
        });

        const menuItems = document.querySelectorAll(".menu a");
        menuItems.forEach(item => {
            item.addEventListener("click", function() {
                const sectionToShow = item.getAttribute("data-section");
                sections.forEach(section => {
                    section.style.display = "none";
                });
                document.getElementById(sectionToShow).style.display = "block";
            });
        });

        // Muestra la sección "Inicio" por defecto cuando se carga la página
        document.getElementById("pagina-principal").style.display = "block";
    });
</script>
