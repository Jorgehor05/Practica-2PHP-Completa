<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, mostrar el mensaje de error
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Inicia Sesión</title>
        <link rel='stylesheet' href='errorsesion.css'>
    </head>
    <body>
        <header>
            <h1>Concesionario Hornos</h1>
        </header>
        <nav>
            <ul>
                <li><a href='../inicio/inicio.php'>Inicio</a></li>
                <li><a href='../cliente/buscarcoche/buscar1.php'>Coches</a></li>
                <li><a href='../errorsesion/errorsesion.php'>Alquilar</a></li>
                <li><a href='../login/login.php'>Iniciar Sesión</a></li>
            </ul>
        </nav>
        <div class='cta-section'>
            <h1>Acceso Restringido</h1>
            <p>Debes iniciar sesión para vender un coche.</p>
            <div class='botones'>
                <a href='../login/login.php' class='btn-comprar'>Iniciar Sesión</a>
                <a href='../registro/Registro.php' class='btn-vender'>Registrarse</a>
            </div>
        </div>
        <footer class='pie'>
        </footer>
    </body>
    </html>";
    exit;
}

// Si está logueado, redirigir a la página de adquisición de coches
header('Location: adquirir.html');
?>
