<HTML LANG="es">
<HEAD>
</HEAD>

<BODY>

<H1>Consulta de alquileres</H1>

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
    echo "<h1>Lista de Alquileres</h1>";
    echo "<table border='1' cellpadding='10'>";
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
    echo "<h1>No hay alquileres registrados</h1>";
}

// Cerrar la conexión
mysqli_close($conexion);
?>


</BODY>
</HTML>
