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
$id = $_REQUEST['id_coche'];

$sql = "SELECT * FROM coches WHERE id_coche = '$id'";
$result = mysqli_query($conn, $sql);

// Enviar consulta
      $instruccion = "select * from usuarios";
      $consulta = mysqli_query ($conn,$instruccion)
         or die ("Fallo en la consulta");
   // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>id_usuario</TH>\n");
         print ("<TH>nombre</TH>\n");
         print ("<TH>apellidos</TH>\n");
		 print ("<TH>dni</TH>\n");
        
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['id_usuario'] . "</TD>\n");
            print ("<TD>" . $resultado['nombre'] . "</TD>\n");
            print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
			print ("<TD>" . $resultado['dni'] . "</TD>\n");
            
            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay usuarios disponibles");


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
<br>
<br>
    <form action="modificarcoche3.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_coche" value="<?php echo $row['id_coche']; ?>">
        <br>
        <label for="modelo">modelo</label>
        <input type="text" name="modelo" value="<?php echo $row['modelo']; ?>" required><br>
		<br>
		<label for="marca">marca</label>
        <input type="text" name="marca" value="<?php echo $row['marca']; ?>" required><br>
		<br>
		<label for="color">color</label>
        <input type="text" name="color" value="<?php echo $row['color']; ?>" required><br>
		<br>
		<label for="precio">precio</label>
        <input type="text" name="precio" value="<?php echo $row['precio']; ?>" required><br>
		<br>
		 <label for="alquilado">¿Está alquilado?</label>
		<select name="alquilado" id="alquilado" required>
        <option value="1">Sí</option>
        <option value="0">No</option>
		</select>
		<label for="imagen">Selecciona una imagen:</label>
		<input type="file" name="image" id="image" accept="image/*">
		<br>
        <br>
		<label for="id_usuario">ID del Usuario (si está alquilado):</label>
		<input type="number" name="id_usuario" id="id_usuario">
		<br>
		<br>
        <input type="submit" value="Actualizar">
    </form>

</body>
</html>

<?php
} else {
    echo "No se encontró el coche.";
}

// Cerrar la conexión
mysqli_close($conn);
?>