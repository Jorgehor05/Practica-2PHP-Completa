<?php
// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_coche'])) {
    $id_coche = intval($_POST['id_coche']);

    // Eliminar alquileres relacionados
    $conn->query("DELETE FROM alquileres WHERE id_coche = $id_coche");

    // Eliminar coche
    $conn->query("DELETE FROM coches WHERE id_coche = $id_coche");

    echo "Coche eliminado correctamente.";
}
?>
