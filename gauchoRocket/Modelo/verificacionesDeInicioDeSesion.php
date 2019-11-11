<?php
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


?>
