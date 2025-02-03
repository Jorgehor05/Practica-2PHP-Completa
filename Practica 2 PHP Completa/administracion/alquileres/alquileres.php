<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP+SQL</title>
    <script>
        function redirigirPagina(selectElement) {
            const url = selectElement.value; // Obtiene el valor seleccionado
            if (url) {
                window.location.href = url; // Redirige a la URL
            }
        }
    </script>
	<link rel="stylesheet" href="alquileres.css">
</head>
<body>

<!-- Menú de navegación -->
    <nav class="menu">
        <ul>
			<li> <h2>Concesionario Hornos <h2></li>	
            <li><a href="../inicio.php">Inicio</a></li>
            <li><a href="../coches/coches.php">Coches</a></li>
            <li><a href="../usuarios/usuarios.php">Usuarios</a></li>
            <li><a href="../alquileres/alquileres.php">Alquileres</a></li>
        </ul>
    </nav>
	
    <form action="coches/añadirCoche.php" method="post">
        <h1>Gestión de Alquileres</h1>
        <select name="accion" onchange="redirigirPagina(this)">
			<option value="" disabled selected></option>
            <option value="./php/listar/listaralquiler.php">Listar alquiler</option>
            <option value="./php/eliminar/eliminaralquiler1.php">Eliminar alquiler</option>
        </select>
    </form>

</body>
</html>