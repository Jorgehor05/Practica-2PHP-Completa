<?php
// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id_usuario = intval($_POST['id_usuario']);

    // Eliminar alquileres relacionados
    $conn->query("DELETE FROM alquileres WHERE id_usuario = $id_usuario");

    // Eliminar usuario
    $conn->query("DELETE FROM usuarios WHERE id_usuario = $id_usuario");

    echo "Usuario eliminado correctamente.";
}
?>
