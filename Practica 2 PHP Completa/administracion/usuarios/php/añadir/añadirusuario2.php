<?PHP
	// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}
		 
   // Recuperar datos del formulario
	  $password = $_REQUEST['password'];
	  $nombre = $_REQUEST['nombre'];
	  $apellido = $_REQUEST['apellido'];
	  $DNI = $_REQUEST['DNI'];
	  $saldo = $_REQUEST['saldo'];
     
	// Preparar y ejecutar la consulta de insercion
		$sql = "INSERT INTO usuarios (password, nombre, apellidos, dni, saldo) VALUES ('$password', '$nombre', '$apellido', '$DNI', '$saldo')";
		
		if (mysqli_query($conn, $sql)) {
			echo "usuario insertado con exito";
		}
		else {
			echo "Eror al insertar el usuario: " . mysqli_error($conn);
		}
			
	// Cerrar 
		mysqli_close ($conn);

?>