<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="inicio.css">
    <script>
        // Función para redirigir a la página seleccionada
        function redirigirPagina() {
            const seleccion = document.getElementById("menu").value;
            if (seleccion) {
                window.location.href = seleccion;
            }
        }
    </script>
</head>
<body>
    <header>
        <h1> Concesionario Hornos</h1>
    </header>
    <main>
        <section class="form-section">
            <select id="menu" onchange="redirigirPagina()">
                <option value="">-- Seleccione una opción --</option>
                <option value="./coches/coches.php">Coches</option>
                <option value="./usuarios/usuarios.php">Usuarios</option>
                <option value="./alquileres/alquileres.php">Alquileres</option>
            </select>
        </section>
    </main>
</body>
</html>
