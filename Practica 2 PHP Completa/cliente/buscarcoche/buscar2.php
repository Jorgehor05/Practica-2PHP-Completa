<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coches</title>
    <link rel="stylesheet" href="buscar1.css">
</head>
<body>
<header>
        <h1>Concesionario Hornos</h1>
 </header>
    <nav>
        <ul>
            <li><a href="../../inicio/inicio.php">Inicio</a></li>
            <li><a href="../../cliente/buscarcoche/buscar1.php">Coches</a></li>
            <li><a href="../../errorsesion/errorsesion.php">Alquilar</a></li>
            <li><a href="../../login/login.php">Iniciar Sesión</a></li>
        </ul>
    </nav>
	<br>
	
<?php
// Configuracion base de datos
		$servername = "localhost";$username = "root";$password = "rootroot";$dbname = "coches";

   // Conectar con el servidor de base de datos
      $conn = mysqli_connect($servername, $username, $password, $dbname);
	  
   // Verificar la conexion
		if (!$conn) {
			die("Conexion fallida: " . mysqli_connect_error());
		}
echo '<!DOCTYPE html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Listado de Coches</title>';
echo '<link rel="stylesheet" href="buscar_coches.css">';
echo '</head>';
echo '<body>';


$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$color = $_POST['color'];
$precio = $_POST['precio'];

$sql = "SELECT * FROM coches WHERE 1=1";

if (!empty($marca)) {
    $sql .= " AND marca LIKE '%$marca%'";
}
if (!empty($modelo)) {
    $sql .= " AND modelo LIKE '%$modelo%'";
}
if (!empty($color)) {
    $sql .= " AND color LIKE '%$color%'";
}
if (!empty($precio)) {
    $sql .= " AND precio <= $precio";
}

// Ejecutar la consulta
$result = mysqli_query($conn, $sql);

// Mostrar resultados
if ($result && mysqli_num_rows($result) > 0) {
    echo "<h2>Resultados de la Búsqueda</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Marca</th><th>Modelo</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['marca']}</td>
                <td>{$row['modelo']}</td>
                <td>{$row['color']}</td>
                <td>{$row['precio']} €</td>
				<td>{$row['alquilado']}</td>
                <td><img src='{$row['foto']}' alt='Foto del coche' class='foto-coche'></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron resultados.</p>";
}

echo '</body>';
echo '</html>';
?>
<br>
<br>
<br>
<section class="cta-section">
	<div class="botones1">
            <a href="../../errorsesion/errorsesion.php" class="btn-comprar"> Comprar coche</a>
     </div>
	</section>