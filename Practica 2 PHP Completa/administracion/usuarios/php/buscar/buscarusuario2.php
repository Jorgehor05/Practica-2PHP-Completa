<?php
// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];

// Construir la consulta SQL dinámicamente
$sql = "SELECT * FROM usuarios 
        WHERE nombre LIKE '%$nombre%' 
          AND apellidos LIKE '%$apellidos%'";
		  
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Resultados de la Búsqueda</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>id_usuario</th><th>password</th><th>nombre</th><th>apellidos</th><th>dni</th><th>saldo</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_usuario']}</td>
                <td>{$row['password']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellidos']}</td>
				<td>{$row['dni']}</td>
				<td>{$row['saldo']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}
?>
