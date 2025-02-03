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

if (isset($_POST['login'])) {
    $dni = $_POST['dni'];
    $password = $_POST['password'];

    $sql = "SELECT u.id_usuario, u.password, t.tipo FROM usuarios u JOIN tipos_usuario t ON u.id_usuario = t.id_usuario WHERE dni = '$dni'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['tipo'] = $row['tipo'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
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
	<link rel="stylesheet" href="login1.css">
	
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
	<h1> Iniciar sesion </h1>
    <input type="text" name="dni" placeholder="DNI" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
	<br>
	¿Has olvidado tu contraseña? <a href="cambiar contraseña.php"> Cambiar contraseña </a>
</form>
