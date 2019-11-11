<?php
if(!isset($_SESSION)){
    session_start();
}
    
$usuario = $_SESSION['user']; //Usuario logueado
include("conexion.php");

/* ==================================================================================== */
/* =============== Verificamos si ya tiene hecha la verificación médica =============== */
/* ==================================================================================== */
$query = "select verifMedica from cliente where fkEmailUsuario like '".$usuario."'";
$resultado = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($resultado);
if($row['verifMedica'] == 1){
    header("Location: ../Vista/datosDelTurno.php");
}else {
    header("Location: ../Vista/turnoMedico.php");
}

$query1 = "select * from turnoMedico where fkEmailCliente like '".$usuario."';";
$resultado1 = mysqli_query($conexion, $query1);
if(mysqli_num_rows($resultado1) >= 1){
    header("Location: ../Vista/datosDelTurno.php");
}else {
    header("Location: ../Vista/turnoMedico.php");
}
/* =============================================== */
/* =============== Fin verificación ============== */
/* =============================================== */





if(isset($_POST['medico'])){
    $codigoCentro = $_POST['codigoCentro'];
    
    /* Obtenemos la cantidad de turno que tiene el centro médico y restamos 1 */
    $consultaUno = "select c.turnos as turnos, l.nombre as nombre
                    from centroMedico as c
                        inner join lugar as l on c.codigoLugar = l.codigo
                    where c.codigo = ".$codigoCentro.";";
    $queryUno = mysqli_query($conexion, $consultaUno);
    
    while($cantidadDeTurnos = mysqli_fetch_assoc($queryUno)){
        $cantidadDeTurnos['turnos'] -= 1;
        $updateUno = "update centroMedico set turnos = ".$cantidadDeTurnos['turnos']." where codigo = ".$codigoCentro.";";
        $queryDos = mysqli_query($conexion, $updateUno);
        
        $insertUno = "insert into turnoMedico (fkEmailCliente, fechaTurnoMedico, codigoLugar, nombreLugar) values
                        ('".$usuario."', date_add(curtime(), interval 5 minute), ".$codigoCentro.", '".$cantidadDeTurnos['nombre']."');";
        $queryTres = mysqli_query($conexion, $insertUno);
        
        $updateDos = "update cliente set codigoCentroMedico = ".$codigoCentro." where fkEmailUsuario like '".$usuario."';";
        $querycuatro = mysqli_query($conexion, $updateDos);
    }
    
    header("Location: ../Vista/datosDelTurno.php");
}
/* ENVIAR A: "../Vista/datosDelTurno.php" */
?>
