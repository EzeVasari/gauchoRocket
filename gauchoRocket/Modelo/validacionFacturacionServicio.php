 <?php

include('conexion.php');

$servicio = $_GET['servicio'];





 $query="select * from tipodeservicio
    where codigoTipoDeServicio ='".$servicio."';";
;

 $resultado = mysqli_query($conexion, $query);
if(mysqli_num_rows($resultado)>= 1)
{
	header('Location: ../Vista/facturacionPorServicio.php?servicio='.$servicio.'');
}else
{
	header('Location: ../Vista/adminFacturacion.php');
}

?>