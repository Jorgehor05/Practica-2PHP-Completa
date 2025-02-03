<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coches</title>
    <link rel="stylesheet" href="buscar.css">
</head>
<body>
<header>
        <h1>Concesionario Hornos</h1>
 </header>
    <nav>
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="coches.html">Coches</a></li>
            <li><a href="alquiler.html">Alquilar</a></li>
            <li><a href="login.html">Iniciar Sesión</a></li>
        </ul>
    </nav>
	<br>
    <div class="container">
        <h1>Buscar Coches</h1>
        <form action="buscar2.php" method="post">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" placeholder="Buscar por marca...">
            
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" placeholder="Buscar por modelo...">
            
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" placeholder="Buscar por color...">
			
			<label for="color"> Precio máximo:</label>
            <input type="number" id="precio" name="precio" placeholder="Buscar por precio máximo...">
            
            <input type="submit" value="Buscar">
        </form>
    </div>
	
	<section class="descripcion">
	<h2 class="dosh2">Servicios Hornos </h2>
	<p class="dosp"> Más de 20 años han hecho de Hornos, el concesionario segunda mano líder en compraventa de vehículos en España. Queremos ofrecerte la mejor opción a la hora de vender o comprar tu coche de ocasión. </a>
	<br>
	<br>
	<p class="dosp"> <a class="azul1">Ventajas de comprar un coche de segunda mano</a>
	<br>
	<br>
Nuestros clientes compran coches de segunda mano porque estos tienen un precio menor que los nuevos, eso es un hecho. La ventaja de hacerlo en Canalcar es que no estás obligado a renunciar a la calidad o a la garantía por este motivo, ni siquiera en coches más básicos. Además, los coches de ocasión se presentan como una oportunidad única para adquirir gama Premium, ya que la calidad de fabricación de este tipo de coches usados los hace conservarse en un perfecto estado –permitiéndote la compra de un coche prácticamente nuevo a un precio mucho menor.<br>
<br>
<br>
<a class="azul1"> Coches de ocasión con garantía </a>
<br>
<br>
En Hornos tenemos los coches de segunda mano con mayor calidad, ya que nuestros vehículos pasan el más riguroso control de calidad de 110 puntos –solo lo supera 1 de cada 4 coches–. Estamos tan seguros de la calidad de nuestros coches de segunda mano que le ofrecemos una Garantía 5 Estrellas muy similar a la de los coches nuevos.<br>
<br>
<br>
<a class="azul1"> Concesionario de ocasión multimarca </a>
<br>
<br>	
En Hornos, el concesionario de coches de ocasión más grande de Madrid, disponemos de una gran variedad de marcas y modelos. Encuentra el vehículo de segunda mano que mejor se adapte a tus necesidades, con la mejor relación calidad-precio. O si lo prefieres, ven a vernos y te aconsejamos.
	<br>
	<br>
	<br>
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
      $instruccion = "select * from coches";
      $consulta = mysqli_query ($conexion,$instruccion)
         or die ("Fallo en la consulta");
   // Mostrar resultados de la consulta
      $nfilas = mysqli_num_rows ($consulta);
	  
echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Listado de Coches</title>';
echo '<link rel="stylesheet" href="listado_coches.css">';
echo '</head>';
echo '<body>';

echo '<h1>Listado de Coches</h1>';


if ($nfilas > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Modelo</th>';
    echo '<th>Marca</th>';
    echo '<th>Color</th>';
    echo '<th>Precio</th>';
    echo '<th>Alquilado</th>';
    echo '<th>Foto</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    for ($i = 0; $i < $nfilas; $i++) {
        $resultado = mysqli_fetch_array($consulta);
        echo '<tr>';
        echo '<td>' . $resultado['modelo'] . '</td>';
        echo '<td>' . $resultado['marca'] . '</td>';
        echo '<td>' . $resultado['color'] . '</td>';
        echo '<td>' . $resultado['precio'] . ' €</td>';
        echo '<td>' . ($resultado['alquilado'] ? 'Sí' : 'No') . '</td>';
        echo '<td><img src="' . $resultado['foto'] . '" alt="Foto del coche" class="foto-coche"></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No hay coches disponibles</p>';
}

// Cerrar 
mysqli_close ($conexion);

echo '</body>';
echo '</html>';
?>	
	
	<br>
	<br>
	<br>
</section>
	<section class="pie">
	<div class="pie">
	</div>
	</section>
	
	
	
	
</body>
</html>

