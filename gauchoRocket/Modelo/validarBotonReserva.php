<?php
session_start();
$usuario = $_SESSION['user'];
include('conexion.php');
$codigo = $_GET['codigo'];

$queryCliente = "select nivelVuelo from cliente where fkEmailUsuario like '".$usuario."';";
$resultadoCliente = mysqli_query($conexion, $queryCliente);
$clienteNivel;
while($cli = mysqli_fetch_assoc($resultadoCliente)){
    $clienteNivel = $cli['nivelVuelo'];
}

$queryViaje = "select e.fkcodigoTipoDeEquipo as numNivel
               from viaje as v inner join equipo as e on v.matriculaEquipo = e.matricula
               where v.codigo = ".$codigo.";";
$resultadoViaje = mysqli_query($conexion, $queryViaje);
$vueloNivel;
while($vue = mysqli_fetch_assoc($resultadoViaje)){
    $vueloNivel = $vue['numNivel'];
}

if($clienteNivel == $vueloNivel || $clienteNivel == null){
    header("Location: ../Vista/reserva.php?codigo=".$codigo."");
}else{
    header("Location: ../Vista/index.php?m=9");
}


?>
