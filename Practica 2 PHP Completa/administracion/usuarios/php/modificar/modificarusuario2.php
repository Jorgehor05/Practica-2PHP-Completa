<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "coches";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname)
or  die("Conexión fallida: " . mysqli_connect_error());

// Recuperar el ID del formulario
$id = $_REQUEST['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Coche</title>
     <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #2c2c2c; /* Fondo gris oscuro */
    color: #f4f4f9; /* Texto claro */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    text-align: center;
    position: relative;
}
body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Oscurece un poco el fondo */
    z-index: -1;
}

h1 {
    font-size: 2.5rem;
    color: #fff;
    margin-bottom: 20px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 1px;
    padding: 10px;
    background-color: #444; /* Fondo más oscuro */
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
}


h2 {
    font-size: 1.5rem;
    color: #f4f4f9;
    margin-bottom: 15px;
    text-transform: uppercase;
    font-weight: 600;
}


form {
    background-color: #3c3c3c; /* Fondo oscuro para el formulario */
    padding: 20px;
    border-radius: 8px;
	 border: 2px solid red;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
    max-width: 400px;
    width: 90%;
    color: #fff; /* Texto claro */
}


select {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #666; /* Borde gris intermedio */
    border-radius: 5px;
    box-sizing: border-box;
    margin-bottom: 15px;
    background-color: #555; /* Fondo gris oscuro */
    color: #f4f4f9; /* Texto claro */
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}


select:focus {
    border-color: #f4f4f9;
    outline: none;
    background-color: #666; /* Fondo ligeramente más claro al enfoque */
}


select option:hover {
    background-color: #444;
    color: #fff;
}


form:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
    transform: scale(1.02);
    transition: all 0.3s ease-in-out;
}

    </style>
</head>
<body>      
    <form action="modificarusuario3.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id_usuario']; ?>">
        <br>
        <label for="password">password</label>
        <input type="text" name="password" value="<?php echo $row['password']; ?>" required><br>
		<br>
		<label for="nombre">nombre</label>
        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
		<br>
		<label for="apellidos">apellidos</label>
        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required><br>
		<br>
		<label for="dni">DNI</label>
        <input type="text" name="dni" value="<?php echo $row['dni']; ?>" required><br>
		<br>
		<label for="saldo">saldo</label>
        <input type="text" name="saldo" value="<?php echo $row['saldo']; ?>" required><br>
        <br>
        <input type="submit" value="Actualizar">
    </form>

</body>
</html>

<?php
} else {
    echo "No se encontró el usuario.";
}

// Cerrar la conexión
mysqli_close($conn);
?>