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

h2 {
	color: white;
    text-align: left;
    margin: 0;
    padding: 0px 0;
    text-transform: uppercase;
    font-size: 1.3rem;
	margin-right: 900px;
}

h1 {
    text-align: left;
    margin: 0;
    padding: 10px 0;
    text-transform: uppercase;
    font-size: 2rem;
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

.menu {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    padding: 10px 0; 
}

.menu ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.menu li {
    margin: 0 15px;
}

.menu a {
    text-decoration: none;
    color: #f4f4f9; 
    font-weight: bold;
    text-transform: uppercase;
    font-size: 1rem;
    padding: 10px 15px; 
    display: inline-block;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.menu a:hover {
    background-color: #666;
    color: #fff;
    border-radius: 5px;
}

body {
    margin: 0;
    padding-top: 70px; 
}


    </style>
</head>
<body>

<!-- Menú de navegación -->
    <nav class="menu">
        <ul>
			<li> <h2> Concesionario Hornos <h2></li>	
            <li><a href="../../../inicio.php">Inicio</a></li>
            <li><a href="../../../coches/coches.php">Coches</a></li>
            <li><a href="../../../usuarios/usuarios.php">Usuarios</a></li>
            <li><a href="../../../alquileres/alquileres.php">Alquileres</a></li>
        </ul>
    </nav>
	
    <form action="añadircoche2.php" method="post" enctype="multipart/form-data">
	<h1> añadir coche </h1>
	<br>

    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" id="modelo" required>
	<br>
	<br>
    <label for="marca">Marca:</label>
    <input type="text" name="marca" id="marca" required>
	<br>
	<br>
    <label for="color">Color:</label>
    <input type="text" name="color" id="color" required>
	<br>
	<br>
    <label for="precio">Precio:</label>
    <input type="number" step="0.01" name="precio" id="precio" required>
	<br>
	<br>
    <label for="alquilado">¿Está alquilado?</label>
    <select name="alquilado" id="alquilado" required>
        <option value="no">No</option>
        <option value="si">Sí</option>
    </select>
	<br>
	<br>
    <label for="id_usuario">ID del Usuario (si está alquilado):</label>
    <input type="number" name="id_usuario" id="id_usuario">
	<br>
	<br>
	<label for="imagen">Selecciona una imagen:</label>
    <input type="file" name="image" id="image" accept="image/*">
	<br>
	<br>
    <input type="submit" value="Registrar Coche">
</form>
<br>
<br>
<?PHP

   // Conectar con el servidor de base de datos
      $conexion = mysqli_connect ("localhost", "root", "rootroot")
         or die ("No se puede conectar con el servidor");
		 
   // Seleccionar base de datos
      mysqli_select_db ($conexion,"coches")
         or die ("No se puede seleccionar la base de datos");
   // Enviar consulta
      $instruccion = "select * from usuarios";
      $consulta = mysqli_query ($conexion,$instruccion)
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

// Cerrar 
mysqli_close ($conexion);

?>
</body>
</html>
