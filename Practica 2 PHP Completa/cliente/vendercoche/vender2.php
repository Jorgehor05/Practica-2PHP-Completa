<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Vendedor') {
    header("Location: ../../errorsesion/errorsesion2.php");
    exit();
}


// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "coches";

// Conectar con la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$precio = $_POST['precio'];
$alquilado = 0; 

// Ruta donde se guardarán las imágenes
$ruta_base = $_SERVER['DOCUMENT_ROOT'] . "/ejercicios/Practica 2 PHP Completa/Practica 2 PHP Completa/cliente/img/";

// Procesar la imagen
$foto_nombre = basename($_FILES['foto']['name']);
$foto_tmp = $_FILES['foto']['tmp_name'];
$foto_destino = $ruta_base . $foto_nombre;

// Mover la imagen a la carpeta de destino
if (move_uploaded_file($foto_tmp, $foto_destino)) {
	// Establecer permisos de lectura y escritura para todos (777)
    chmod($foto_destino, 0777);
    // Guardar solo la ruta relativa en la base de datos
    $foto_db = "img/" . $foto_nombre;
} else {
    die("Error al subir la imagen.");
}

// Validar que los campos no estén vacíos
if (empty($marca) || empty($modelo) || empty($color) || empty($precio) || empty($foto_db)) {
    die("Error: Todos los campos son obligatorios.");
}

// Insertar en la base de datos
$sql = "INSERT INTO coches (modelo, marca, color, precio, alquilado, foto) 
        VALUES ('$modelo', '$marca', '$color', $precio, $alquilado, '$foto_db')";

if (mysqli_query($conn, $sql)) {
    echo "Coche añadido con éxito. <a href='vender.php'>Volver</a>";
} else {
    echo "Error al añadir el coche: " . mysqli_error($conn);
}

// Cerrar conexión
mysqli_close($conn);
?>
