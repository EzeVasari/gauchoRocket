<?php
include('conexion.php');
$codigo = $_GET['codigo'];
session_start();
$usuario = $_SESSION['user'];

$queryCliente = "select nivelVuelo from cliente where fkEmailUsuario like '".$usuario."';";
$resultadoCliente = mysqli_query($conexion, $queryCliente);

$queryViaje = "select e.fkcodigoTipoDeEquipo as numNivel
               from viaje as v inner join equipo as e on v.matriculaEquipo = e.matricula
               where v.codigo = ".$codigo.";";
$resultadoViaje = mysqli_query($conexion, $queryViaje);



$clienteNivel;
while($cli = mysqli_fetch_assoc($queryCliente)){
    $clienteNivel = $cli['nivelVuelo'];
}

$vueloNivel;
while($vue = mysqli_fetch_assoc($queryViaje)){
    $vueloNivel = $vue['numNivel'];
}

if($clienteNivel == $vueloNivel){
    header("Location: ../Vista/reserva.php?codigo=".$codigo."");
}else{
    header("Location: ../Vista/index.php?m=9");
}


?>
