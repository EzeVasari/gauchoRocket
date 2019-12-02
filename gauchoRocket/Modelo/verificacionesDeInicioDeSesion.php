<?php
include('conexion.php');
$usuario = $_SESSION['user'];
$fecha_actual = strtotime(date("d-m-Y H:i:00",time())); //Fecha-hora actuales

function generarCodigoReserva($longitud) {
    $key = '';
    $pattern = '123';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}

$consultaUno = "select t.fechaTurnoMedico as fecha, c.verifMedica as medico
                from turnoMedico as t
                    inner join cliente as c on t.fkEmailCliente = c.fkEmailUsuario
                where t.fkEmailCliente like '".$usuario."';";
$queryUno = mysqli_query($conexion, $consultaUno);

while($verificar = mysqli_fetch_assoc($queryUno)){
    if($verificar['medico'] == 0){
        
        $fecha = $verificar['fecha'];
        $fecha_entrada = strtotime("$fecha");
          
        $codigoViaje = generarCodigoReserva(1);
      
        if($fecha_actual >= $fecha_entrada){
            $actualizarUno = "update cliente set verifMedica = true, nivelVuelo = ".$codigoViaje."
                                where fkEmailUsuario like '".$usuario."';";
            $actualizarDos = mysqli_query($conexion, $actualizarUno);
        }
    }
}

$queryNivelCliente = "select nivelVuelo
                      from cliente
                      where fkEmailUsuario like '".$usuario."'";
$resultadoQuery = mysqli_query($conexion, $queryNivelCliente);
$nivelCliente;
while($row = mysqli_fetch_assoc($resultadoQuery)){
    $nivelCliente = $row['nivelVuelo'];
}

$queryReservas = "SELECT e.fkcodigoTipoDeEquipo as numNivel, ir.idItemReserva as itRev
                FROM viaje as v
                    inner join equipo as e on v.matriculaEquipo = e.matricula
                    inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                    inner join reserva as r on u.fkCodigoReserva = r.codigo
                    inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                    inner join relacionClienteItemReserva as rel on ir.idItemReserva = rel.fkIdItemReserva
                where rel.fkEmailCliente like '".$usuario."';";
$resultadoReservas = mysqli_query($conexion, $queryReservas);

/*EMPIEZA LA VALIDACION DE RESERVAS*/

$i;

while($reservas = mysqli_fetch_assoc($resultadoReservas)){
    if($reservas['numNivel'] != $nivelCliente){
        $itemReserva = "select fkCodigoReserva as reser
                        from itemReserva
                        where idItemReserva = ".$reservas['itRev'].";";
        $resulSubQuery = mysqli_query($conexion, $itemReserva);
        $codRev;
        while($subQuery = mysqli_fetch_assoc($resulSubQuery)){
            $codRev = $subQuery['reser'];
        }
        
        $deleteUno = "delete from relacionClienteItemReserva where fkIdItemReserva = ".$reservas['itRev'].";";
        $resulDeleteUno = mysqli_query($conexion, $deleteUno);
        
        $deleteDos = "delete from itemReserva where idItemReserva = ".$reservas['itRev'].";";
        $resulDeleteDos = mysqli_query($conexion, $deleteDos);
        
        $deleteTres = "delete from ubicacion where fkCodigoReserva like '".$codRev."';";
        $resulDeleteTres = mysqli_query($conexion, $deleteTres);
        
        $deleteCuatro = "delete from relacionreservatrayecto where fkCodigoReserva like '".$codRev."';";
        $resulDeleteCuatro = mysqli_query($conexion, $deleteCuatro);
        
        $deleteCinco = "delete from reserva where codigo like '".$codRev."';";
        $resulDeleteCinco = mysqli_query($conexion, $deleteCinco);
        
        $i = 1;
    }
}

?>























































