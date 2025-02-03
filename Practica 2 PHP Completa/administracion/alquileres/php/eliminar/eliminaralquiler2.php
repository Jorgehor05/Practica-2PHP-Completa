<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "rootroot", "coches")
    or die("No se pudo conectar a la base de datos");

// Obtener el ID del coche desde el formulario
$id_coche = $_POST['id_coche'];

// Verificar si el coche está alquilado
$query_check = "SELECT alquilado FROM coches WHERE id_coche = $id_coche";
$result_check = mysqli_query($conexion, $query_check);

if ($result_check) {
    $row = mysqli_fetch_assoc($result_check);

    // Si el coche está alquilado
    if ($row['alquilado'] == 1) {
        // Eliminar el registro de la tabla `alquileres`
        $query_delete_alquiler = "DELETE FROM alquileres WHERE id_coche = $id_coche";
        if (!mysqli_query($conexion, $query_delete_alquiler)) {
            die("Error al eliminar el alquiler: " . mysqli_error($conexion));
        }

        // Actualizar el campo `alquilado` a 0 en la tabla `coches`
        $query_update_coche = "UPDATE coches SET alquilado = 0 WHERE id_coche = $id_coche";
        if (!mysqli_query($conexion, $query_update_coche)) {
            die("Error al actualizar el estado del coche: " . mysqli_error($conexion));
        }

        echo "El alquiler ha sido eliminado";
    } else {
        echo "El coche no está alquilado";
    }
} else {
    echo "Error al verificar el estado del coche";
}

// Cerrar la conexión
mysqli_close($conexion);
?>



