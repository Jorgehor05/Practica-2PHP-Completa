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

if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO usuarios (password, nombre, apellidos, dni) VALUES ('$password', '$nombre', '$apellidos', '$dni')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        $sql_tipo = "INSERT INTO tipos_usuario (id_usuario, tipo) VALUES ($user_id, '$tipo')";
        $conn->query($sql_tipo);

        // Redirección automática a la página de inicio de sesión
        header("Location: ../login/login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
	<link rel="stylesheet" href="registro1.css">
	
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
<h1> Registra un usuario </h1>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellidos" placeholder="Apellidos" required>
    <input type="text" name="dni" placeholder="DNI" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="tipo">
        <option value="Comprador">Comprador</option>
        <option value="Vendedor">Vendedor</option>
    </select>
    <button type="submit" name="register">Register</button>
	
	Si ya tiene una cuenta acceda aqui <a href="../login/login.php">login </a>
</form>