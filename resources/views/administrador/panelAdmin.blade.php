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
            <div id="pagina-principal" style="display: none;">
                <h1>pagina principal</h1>
            </div>
            <div id="user-list-container" style="display: none;">
                <!-- Aquí se mostrará la lista de usuarios cuando se hace clic en "Usuarios" -->
                <h1>soy usuario</h1>
            </div>
            <div id="pagina-personal" style="display: none;">
                <h1>aqui la lista del personal crud general</h1>
            </div>
            <div id="pagina-productos" style="display: none;">
                <h1>aqui la lista de productos con crud general</h1>
            </div>
            <div id="pagina-reportes" style="display: none;">
                <h1>pagina de reporte de inventario de costo y ganancias</h1>
            </div>
            <div id="pagina-spam" style="display: none;">
                <h1>aqui se enviara cualquier mensaje al cliente tanto como anuncio o cambio de contraseñas</h1>
            </div>
            <div id="pagina-configuracion" style="display: none;">
                <h1>pagina donde ira algunas modificaciones al sistema, como ser el logo y otras cosas mas </h1>
            </div>
        </div>
    </main>
</div>

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
