<HTML LANG="es">
<HEAD>
</HEAD>

<BODY>

<H1>Consulta de usuarios</H1>

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
         print ("<TH>password</TH>\n");
         print ("<TH>nombre</TH>\n");
         print ("<TH>apellidos</TH>\n");
		 print ("<TH>dni</TH>\n");
         print ("<TH>saldo</TH>\n");
        
         print ("</TR>\n");

         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mysqli_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['id_usuario'] . "</TD>\n");
            print ("<TD>" . $resultado['password'] . "</TD>\n");
            print ("<TD>" . $resultado['nombre'] . "</TD>\n");
            print ("<TD>" . $resultado['apellidos'] . "</TD>\n");
			print ("<TD>" . $resultado['dni'] . "</TD>\n");
			print ("<TD>" . $resultado['saldo'] . "</TD>\n");
            
            print ("</TR>\n");
         }

         print ("</TABLE>\n");
      }
      else
         print ("No hay usuarios disponibles");

// Cerrar 
mysqli_close ($conexion);

?>

</BODY>
</HTML>
