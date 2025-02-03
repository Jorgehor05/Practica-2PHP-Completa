<HTML LANG="es">
<HEAD>
</HEAD>

<BODY>

<H1>Consulta de coches disponibles</H1>

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
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>id_coche</TH>\n");
         print ("<TH>modelo</TH>\n");
         print ("<TH>marca</TH>\n");
         print ("<TH>color</TH>\n");
		 print ("<TH>precio</TH>\n");
         print ("<TH>alquilado</TH>\n");
         print ("<TH>foto</TH>\n");

        
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['id_coche'] . "</TD>\n");
            print ("<TD>" . $resultado['modelo'] . "</TD>\n");
            print ("<TD>" . $resultado['marca'] . "</TD>\n");
            print ("<TD>" . $resultado['color'] . "</TD>\n");
			print ("<TD>" . $resultado['precio'] . "</TD>\n");
			print ("<TD>" . $resultado['alquilado'] . "</TD>\n");
			print ("<TD>" . $resultado['foto'] . "</TD>\n");

            
            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay coches disponibles");

// Cerrar 
mysqli_close ($conexion);

?>

</BODY>
</HTML>
