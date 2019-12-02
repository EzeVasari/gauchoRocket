<?php

include ('conexion.php');


$matricula = $_GET["matricula"];


$eliminarEquipo = "delete from equipo
where matricula='".$matricula."'";

$eliminar1= mysqli_query($conexion, $eliminarEquipo);



if ($eliminar1== true) {
	header('location: ../Vista/equipoEliminado.php');
}else
{
	header('location: ../Vista/adminBusquedaMantenimiento.php');
}




?>