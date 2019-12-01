<?php

include ('conexion.php');


$codigoVuelo = $_GET["codigo"];


$eliminarTrayectos = "delete from relacionviajetrayecto
where fkCodigoViaje='".$codigoVuelo."'";

$eliminar1= mysqli_query($conexion, $eliminarTrayectos);

$eliminarViaje = "delete from viaje
where codigo='".$codigoVuelo."'";

$eliminar2= mysqli_query($conexion, $eliminarViaje);


if ($eliminar1== true && $eliminar2==true) {
	header('location: ../Vista/viajeEliminado.php');
}else
{
	header('location: ../Vista/adminBusquedaMantenimiento.php');
}




?>