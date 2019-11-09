<?php
session_start();
    
if(!isset($_SESSION['user'])){
    header("Location: ../Vista/ERROR_pago.php");
    exit();
}

include("conexion.php");

$usuario = $_SESSION['user']; //Usuario logueado
$codigo = $_GET["codigo"]; //Código de la reserva a pagar

/* =============== Verificamos que tenga la verificación hecha para poder abonar la reserva =============== */ 
$query = "select verifMedica from cliente where fkEmailUsuario like '".$usuario."'";
$resultado = mysqli_query($conexion, $query);
$verifmedica = mysqli_fetch_assoc($resultado);
if($verifmedica['verifMedica'] == false){
    header("Location: ../Vista/ERROR_pago.php");
    exit();
}else
{

	header('Location: ../Vista/IngresoDePago.php?reserva="'.$codigo = $_GET["codigo"].'"');

}


/* =============== Fin verificamos =============== */ 

/*$codigo = $_GET["codigo"]; //Código de la reserva a pagar

$query = "select nombre from lugar where codigo = 1"; //Lugar del centro médico
$resultado = mysqli_query($conexion, $query);
$nombre = mysqli_fetch_assoc($resultado);

$insert = "insert into turnoMedico (codigoCliente, codigoLugar, nombreLugar) values
            ('".$usuario."', ".$codigo.", '".$nombre['nombre']."');
          ";

$resultado = mysqli_query($conexion, $insert);*/





?>
