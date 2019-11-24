 <?php

include('conexion.php');

$cabina = $_GET['cabina'];





 $query="select codigoTipoDeCabina, descripcion from tipoDeCabina
    where codigoTipoDeCabina ='".$cabina."';";
;

 $resultado = mysqli_query($conexion, $query);
if(mysqli_num_rows($resultado)>= 1)
{
	header('Location: ../Vista/facturacionPorCabina.php?cabina='.$cabina.'');
}else
{
	header('Location: ../Vista/adminFacturacion.php');
}

?>