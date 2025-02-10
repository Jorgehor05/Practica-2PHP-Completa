<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "coches";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_POST['update_password'])) {
    $dni = $_POST['dni'];
    $new_password = $_POST['password'];

    $sql_check = "SELECT * FROM usuarios WHERE dni = '$dni'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE usuarios SET password = '$new_password' WHERE dni = '$dni'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Contraseña actualizada correctamente";
        } else {
            echo "Error al actualizar la contraseña " . $conn->error;
        }
    } else {
        echo "No se encontró un usuario con ese DNI";
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP+SQL</title>
    <script>
        function redirigirPagina(selectElement) {
            const url = selectElement.value; // Obtiene el valor seleccionado
            if (url) {
                window.location.href = url; // Redirige a la URL
            }
        }
    </script>
	<link rel="stylesheet" href="cambiarcontra.css">
	
</head>
<body>

<!-- Menú de navegación -->
    <nav class="menu">
        <ul>
			<li> <h2>Concesionario Hornos <h2></li>	
            <li><a href="../login/login.php"> Login </a></li>
            <li><a href="../registro/Registro.php"> Registrarse </a></li>
        </ul>
    </nav>
	
<form method="POST" action="">
	<h1> Cambiar contraseña </h1>
    <input type="text" name="dni" placeholder="DNI" required>
    <input type="password" name="password" placeholder="Nueva contraseña" required>
    <button type="submit" name="update_password">Aceptar</button>
</form>
