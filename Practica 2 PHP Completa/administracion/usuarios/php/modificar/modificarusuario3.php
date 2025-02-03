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
// Recuperar datos del formulario
$id = $_REQUEST['id'];
$password =  $_REQUEST['password'];
$nombre =  $_REQUEST['nombre'];
$apellido = $_REQUEST['apellidos'];
$dni = $_REQUEST['dni'];
$saldo = $_REQUEST['saldo'];

// Preparar y ejecutar la consulta de inserción
$sql = "UPDATE usuarios SET password='$password', nombre='$nombre', apellidos='$apellido', dni='$dni', saldo='$saldo' WHERE id_usuario='$id'";


if (mysqli_query($conn, $sql)) {
    echo "Usuario actualizado con éxito.";
} else {
    echo "Error al actualizar: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>