<?php
session_start();

if (isset($_POST['login'])) {
    $dni = $_POST['dni'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "rootroot", "coches");
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario'] = $user['id'];
            $_SESSION['rol'] = $user['tipo']; // Guardar el rol (comprador/vendedor)

            // Redirigir a la página guardada en la sesión o al inicio
            $redirect_to = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../../inicio/inicio.php';
            unset($_SESSION['redirect_to']); // Limpiar la sesión de redirección
            header("Location: $redirect_to");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No se encontró un usuario con ese DNI.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="../../inicio/inicio.php">Inicio</a></li>
        <li><a href="../../cliente/buscarcoche/buscar1.php">Buscar Coches</a></li>
        <li><a href="../../login/login.php">Iniciar Sesión</a></li>
    </ul>
</nav>

<form method="POST" action="">
    <h1>Iniciar sesión</h1>
    <input type="text" name="dni" placeholder="DNI" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
    <br>
    ¿Has olvidado tu contraseña? <a href="../login/cambiar contraseña.php">Cambiar contraseña</a>
</form>
</body>
</html>
