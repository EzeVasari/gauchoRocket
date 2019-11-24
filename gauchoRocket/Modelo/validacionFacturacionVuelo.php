 <?php

include('conexion.php');

$vuelo = $_GET['vuelo'];





 $query="select * 
from itemReserva as i inner join reserva as r on r.codigo = i.fkcodigoReserva inner join viaje as v on
    v.codigo= r.codigoViaje 
    where v.codigo='".$vuelo."';";
;

 $resultado = mysqli_query($conexion, $query);
if(mysqli_num_rows($resultado)>= 1)
{
	header('Location: ../Vista/facturacionPorVuelo.php?vuelo='.$vuelo.'');
}else
{
	header('Location: ../Vista/adminFacturacion.php');
}

?>