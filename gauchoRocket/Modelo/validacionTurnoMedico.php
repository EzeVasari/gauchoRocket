<?php
session_start();
    
if(!isset($_SESSION['user'])){
    echo "USTED NO PUEDE HACER RESERVAS";
    header("Location: ../Vista/ERROR_turno_medico.php");
    exit();
}

include("conexion.php");

$usuario = $_SESSION['user']; //Usuario logueado

/* =============== Verificamos si ya tiene hecha la verificación médica =============== */ 
$query = "select verifMedica from cliente where usuario like '".$usuario."'";
$resultado = mysqli_query($conexion, $query);
$verifmedica = mysqli_fetch_assoc($resultado);
if($verifmedica['verifMedica'] == true){
    header("Location: ../Vista/ERROR_turno_medico_realizado.php");
    exit();
}
/* =============== Fin verificamos =============== */ 

$codigo = $_GET["codigo"]; //Código del centro médico
$usuario = $_SESSION['user']; //Usuario logueado

$query = "select nombre from lugar where codigo = ".$codigo; //Lugar del centro médico
$resultado = mysqli_query($conexion, $query);
$nombre = mysqli_fetch_assoc($resultado);

$insert = "insert into turnoMedico(cliente, codigolugar, nombrelugar) values
            ('".$usuario."', ".$codigo.", '".$nombre['nombre']."');
          ";

$resultado = mysqli_query($conexion, $insert);

header("Location: ../Vista/index.php");
?>
