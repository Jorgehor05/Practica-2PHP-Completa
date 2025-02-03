<?PHP
	// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}
	
	// Directorio donde se guardarán las imágenes
	$target_dir = "img/";
	
	// Verificar si se envió un archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    // Obtener el nombre y ruta del archivo destino
    $target_file = $target_dir . basename($file["name"]);

    // Verificar si el archivo es realmente una imagen
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        die("El archivo seleccionado no es una imagen.");
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        die("El archivo ya existe en el servidor.");
    }

    // Intentar mover el archivo al directorio de destino
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "La imagen " . htmlspecialchars(basename($file["name"])) . " se ha subido correctamente.";
    } else {
        echo "Hubo un error al subir el archivo.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}

   // Recuperar datos del formulario
      $modelo = $_REQUEST['modelo'];
	  $marca = $_REQUEST['marca'];
	  $color = $_REQUEST['color'];
	  $precio = $_REQUEST['precio'];
	  $alquilado = isset($_POST['alquilado']) && $_POST['alquilado'] === 'si' ? 1 : 0; //Si la condición completa (isset($_POST['alquilado']) && $_POST['alquilado'] === 'si') es verdadera, entonces se asigna el valor 1 a $alquilado. Si la condición es falsa, se asigna el valor 0 a $alquilado.
	  $id_usuario = $_POST['id_usuario']; 			// ID del usuario que alquila el coche (si aplica)
     
	// Preparar y ejecutar la consulta de insercion
		$sql = "INSERT INTO coches (modelo, marca, color, precio, alquilado, foto) VALUES ('$modelo', '$marca', '$color', '$precio', '$alquilado', '$target_file')";
		
		if (mysqli_query($conn, $sql)) {
			echo "coche insertado con exito";
		}
		else {
			echo "Eror al insertar el coche: " . mysqli_error($conn);
		}
			
		if ($alquilado === 1) {
    // Obtener el ID del coche recién insertado
    $id_coche = mysqli_insert_id($conn);

    // Insertar en la tabla `alquileres`
    $query_alquileres = "INSERT INTO alquileres (id_usuario, id_coche, prestado) 
                         VALUES ($id_usuario, $id_coche, NOW())"; //La función now() inserta la fecha y hora actuales en la columna prestado del registro.
    mysqli_query($conn, $query_alquileres) or die("Error al registrar el alquiler: " . mysqli_error($conn));
	}
	
	// Cerrar 
		mysqli_close ($conn);

?>