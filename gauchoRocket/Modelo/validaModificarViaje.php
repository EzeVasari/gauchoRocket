<?php


    include('conexion.php');

      $codigoVuelo = $_GET["codigo"];
      $nombre = $_POST["nombre"];
      $descripcion = $_POST["descripcion"];
      $precio = $_POST["precio"];
$destino = $_POST["destino"];
$origen = $_POST["origen"];    
          


    $modificar1 = "UPDATE viaje SET nombre = '". $nombre ."' 
    WHERE codigo =  '". $codigoVuelo . "'";
$resultado1 = mysqli_query($conexion, $modificar1);

$modificar2 = "UPDATE viaje SET descripcion = '". $descripcion ."' 
    WHERE codigo =  '". $codigoVuelo . "'";
$resultado2 = mysqli_query($conexion, $modificar2);

$modificar3 = "UPDATE viaje SET precio = '". $precio ."' 
    WHERE codigo =  '". $codigoVuelo . "'";
$resultado3 = mysqli_query($conexion, $modificar3);



if ($resultado1==TRUE && $resultado2==TRUE && $resultado3== TRUE) {
  $modificar4 = "UPDATE viaje SET destino = '". $destino ."' 
    WHERE codigo =  '". $codigoVuelo . "'";
$resultado4 = mysqli_query($conexion, $modificar4);

$modificar5 = "UPDATE viaje SET origen = '". $origen ."' 
    WHERE codigo =  '". $codigoVuelo . "'";
$resultado5 = mysqli_query($conexion, $modificar5);
   header('Location: ../Vista/ingresarTrayectos.php?viaje='.$codigoVuelo.'');
}
else
{
 header('Location: ../Vista/adminBusquedaMantenimiento.php');
}

      
     
      
   
    
     
  

        
      ?>