<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP+SQL</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #2c2c2c; /* Fondo gris oscuro */
    color: #f4f4f9; /* Texto claro */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    text-align: center;
    position: relative;
}
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Oscurece un poco el fondo */
    z-index: -1;
}

h2 {
	color: white;
    text-align: left;
    margin: 0;
    padding: 0px 0;
    text-transform: uppercase;
    font-size: 1.3rem;
	margin-right: 900px;
}

h1 {
    text-align: left;
    margin: 0;
    padding: 10px 0;
    text-transform: uppercase;
    font-size: 2rem;
}


form {
    background-color: #3c3c3c; /* Fondo oscuro para el formulario */
    padding: 20px;
    border-radius: 8px;
	 border: 2px solid red;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
    max-width: 400px;
    width: 90%;
    color: #fff; /* Texto claro */
}


select {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #666; /* Borde gris intermedio */
    border-radius: 5px;
    box-sizing: border-box;
    margin-bottom: 15px;
    background-color: #555; /* Fondo gris oscuro */
    color: #f4f4f9; /* Texto claro */
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}


select:focus {
    border-color: #f4f4f9;
    outline: none;
    background-color: #666; /* Fondo ligeramente más claro al enfoque */
}


select option:hover {
    background-color: #444;
    color: #fff;
}


form:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
    transform: scale(1.02);
    transition: all 0.3s ease-in-out;
}

.menu {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    padding: 10px 0; 
}

.menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.menu li {
    margin: 0 15px;
}

.menu a {
    text-decoration: none;
    color: #f4f4f9; 
    font-weight: bold;
    text-transform: uppercase;
    font-size: 1rem;
    padding: 10px 15px; 
    display: inline-block;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.menu a:hover {
    background-color: #666;
    color: #fff;
    border-radius: 5px;
}

body {
    margin: 0;
    padding-top: 70px; 
}


    </style>
</head>
<body>

<!-- Menú de navegación -->
    <nav class="menu">
        <ul>
			<li> <h2> Concesionario Hornos <h2></li>	
            <li><a href="../../../inicio.php">Inicio</a></li>
            <li><a href="../../../coches/coches.php">Coches</a></li>
            <li><a href="../../../usuarios/usuarios.php">Usuarios</a></li>
            <li><a href="../../../alquileres/alquileres.php">Alquileres</a></li>
        </ul>
    </nav>
	
    <section id="alquileres">
    <form action="eliminarcoche2.php" method="post">
		<h1>Eliminar Alquileres</h1>
        <label for="id_coche">ID del Coche:</label>
        <input type="number" name="id_coche" id="id_coche" required>
        <input type="submit" value="Eliminar Alquiler">
    </form>
    </section>
<br>
<br>
<?PHP

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "rootroot", "coches")
    or die("No se pudo conectar a la base de datos");

// Consulta para obtener todos los registros de la tabla `alquileres`
$query = "SELECT a.id_alquiler, a.id_usuario, 
                 a.id_coche, c.modelo AS modelo_coche, c.marca AS marca_coche, 
                 a.prestado, a.devuelto 
          FROM alquileres a
          LEFT JOIN usuarios u ON a.id_usuario = u.id_usuario
          LEFT JOIN coches c ON a.id_coche = c.id_coche";

$result = mysqli_query($conexion, $query) or die("Error en la consulta: " . mysqli_error($conexion));

// Verificar si hay resultados
if (mysqli_num_rows($result) > 0) {
    echo "<h3>Lista de Alquileres</h3>";
    echo "<table cellpadding='8'>";
    echo "<thead>
            <tr>
                <th>ID Alquiler</th>
                <th>ID Usuario</th>
                <th>ID Coche</th>
                <th>Modelo Coche</th>
                <th>Marca Coche</th>
                <th>Prestado</th>
                <th>Devuelto</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Mostrar cada fila de resultados
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_alquiler'] . "</td>";
        echo "<td>" . $row['id_usuario'] . "</td>";
        echo "<td>" . $row['id_coche'] . "</td>";
        echo "<td>" . $row['modelo_coche'] . "</td>";
        echo "<td>" . $row['marca_coche'] . "</td>";
        echo "<td>" . $row['prestado'] . "</td>";
        echo "<td>" . ($row['devuelto'] ? $row['devuelto'] : "Pendiente") . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<h3>No hay alquileres registrados</h3>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

</body>
</html>

