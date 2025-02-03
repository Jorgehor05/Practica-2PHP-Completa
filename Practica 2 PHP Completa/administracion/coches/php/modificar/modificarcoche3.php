<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "coches";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
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
$id_coche = $_REQUEST['id_coche'];
$marca =  $_REQUEST['marca'];
$modelo =  $_REQUEST['modelo'];
$color = $_REQUEST['color'];
$precio = $_REQUEST['precio'];
$alquilado = $_REQUEST['alquilado']; // 1 = Sí, 0 = No
$id_usuario = $_REQUEST['id_usuario']; // ID del usuario que alquila el coche (si aplica)



// Preparar y ejecutar la consulta de inserción
$sql = "UPDATE coches SET marca='$marca', modelo='$modelo', color='$color', precio='$precio', foto='$target_file' WHERE id_coche='$id_coche'";


if (mysqli_query($conn, $sql)) {
    echo "Coche actualizado con éxito.";
} else {
    echo "Error al actualizar: " . mysqli_error($conn);
}

if ($alquilado == 1) {
    // Verificar si ya existe un registro en `alquileres` para este coche
    $query_check_alquiler = "SELECT id_alquiler FROM alquileres WHERE id_coche = $id_coche";
    $result_check = mysqli_query($conn, $query_check_alquiler);

    if (mysqli_num_rows($result_check) > 0) {
        // Si ya existe, actualizar el usuario y la fecha de préstamo
        $query_update_alquiler = "UPDATE alquileres 
                                  SET id_usuario = $id_usuario, 
                                      prestado = NOW() 
                                  WHERE id_coche = $id_coche";
        mysqli_query($conn, $query_update_alquiler) or die("Error al actualizar el alquiler: " . mysqli_error($conn));
    } else {
        // Si no existe, insertar un nuevo registro
        $query_insert_alquiler = "INSERT INTO alquileres (id_usuario, id_coche, prestado) 
                                  VALUES ($id_usuario, $id_coche, NOW())";
        mysqli_query($conn, $query_insert_alquiler) or die("Error al insertar el alquiler: " . mysqli_error($conn));
    }
} else {
    // Si el coche ya no está alquilado, eliminar de la tabla `alquileres`
    $query_delete_alquiler = "DELETE FROM alquileres WHERE id_coche = $id_coche";
    mysqli_query($conn, $query_delete_alquiler) or die("Error al eliminar el alquiler: " . mysqli_error($conn));
}

// Cerrar la conexión
mysqli_close($conn);

// Confirmar éxito
echo "Coche actualizado con éxito.";
?>