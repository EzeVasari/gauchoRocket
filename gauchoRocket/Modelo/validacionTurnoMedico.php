<?php
if(!isset($_SESSION)){
    session_start();
}
    
$usuario = $_SESSION['user']; //Usuario logueado1
include("conexion.php");


/* =============== Verificamos si ya tiene hecha la verificación médica =============== */ 
    $query = "select verifMedica from cliente where fkEmailUsuario like '".$usuario."'";
    $resultado = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($resultado);

    if($row['verifMedica'] == 1){
        header("Location: ../Vista/datosDelTurno.php");

    }else {
        header("Location: ../Vista/turnoMedico.php");
    }
     /* =============== Fin verificamos =============== */ 

     /*   $codigo = $_GET["codigo"]; //Código del centro médico
        $usuario = $_SESSION['user']; //Usuario logueado

        $query = "select nombre from lugar where codigo = ".$codigo; //Lugar del centro médico
        $resultado = mysqli_query($conexion, $query);
        $nombre = mysqli_fetch_assoc($resultado);

        $insert = "insert into turnoMedico(cliente, codigolugar, nombrelugar) values
                    ('".$usuario."', ".$codigo.", '".$nombre['nombre']."');
                  ";

        $resultado = mysqli_query($conexion, $insert);

        */
?>
