<?php
// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];

// Construir la consulta SQL dinámicamente
$sql = "SELECT * FROM coches 
        WHERE marca LIKE '%$marca%' 
          AND modelo LIKE '%$modelo%' 
          AND color LIKE '%$color%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Resultados de la Búsqueda</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Marca</th><th>Modelo</th><th>Color</th><th>Precio</th><th>foto</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['marca']}</td>
                <td>{$row['modelo']}</td>
                <td>{$row['color']}</td>
                <td>{$row['precio']}</td>
				<td>{$row['foto']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}
?>
