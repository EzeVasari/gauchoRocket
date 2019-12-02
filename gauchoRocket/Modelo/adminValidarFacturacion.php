<?php
include('conexion.php');

if(isset($_POST["buscar"])){
    $totalPeriodo = $_POST['totalPeriodo'];
    $totalAntiguedad = $_POST['totalAntiguedad'];
    if($totalPeriodo == 1){$tiempoTotal = "day";
    }elseif($totalPeriodo == 2){$tiempoTotal = "week";
    }elseif($totalPeriodo == 3){$tiempoTotal = "month";
    }elseif($totalPeriodo == 4){$tiempoTotal = "year";}
    if($totalPeriodo > 0 and $totalAntiguedad > 0){
        $queryTotalUno = "select sum(v.precio) as sumaViaje, sum(ts.precio) as sumaServicio, sum(tc.precio) as sumaCabina
                          from viaje as v
                            inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                          where ir.fechaQuePidioReserva between date_sub(now(), interval ".$totalAntiguedad." ".$tiempoTotal.") and now();";
    }
    
    $vuelo = $_POST['vuelo'];
    $vueloPeriodo = $_POST['vueloPeriodo'];
    $vueloAntiguedad = $_POST['vueloAntiguedad'];
    if($vueloPeriodo == 1){$tiempoVuelo = "day";
    }elseif($vueloPeriodo == 2){$tiempoVuelo = "week";
    }elseif($vueloPeriodo == 3){$tiempoVuelo = "month";
    }elseif($vueloPeriodo == 4){$tiempoVuelo = "year";}
    if($vuelo > 0 and $vueloPeriodo > 0 and $vueloAntiguedad > 0){
        $queryVueloUno = "select sum(v.precio) as cantidad, v.nombre as nombre
                          from viaje as v
                            inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                          where ir.fechaQuePidioReserva between date_sub(now(), interval ".$totalAntiguedad." ".$tiempoVuelo.") and now()
                            and v.codigo = ".$vuelo.";";
    }
    
    $servicio = $_POST['servicio'];
    $servicioPeriodo = $_POST['servicioPeriodo'];
    $servicioAntiguedad = $_POST['servicioAntiguedad'];
    if($servicioPeriodo == 1){$tiempoServicio = "day";
    }elseif($servicioPeriodo == 2){$tiempoServicio = "week";
    }elseif($servicioPeriodo == 3){$tiempoServicio = "month";
    }elseif($servicioPeriodo == 4){$tiempoServicio = "year";}
    if($servicio > 0 and $servicioPeriodo > 0 and $servicioAntiguedad > 0){
        $queryServicioUno = "select sum(ts.precio) as cantidad, ts.descripcion as nombre
                             from viaje as v
                                inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                                inner join reserva as r on u.fkCodigoReserva = r.codigo
                                inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                                inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                                inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                                inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                                inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                          where ir.fechaQuePidioReserva between date_sub(now(), interval ".$totalAntiguedad." ".$tiempoServicio.") and now()
                                and s.fkcodigoTipoDeServicio = ".$servicio.";";
    }
    
    $cabina = $_POST['cabina'];
    $cabinaPeriodo = $_POST['cabinaPeriodo'];
    $cabinaAntiguedad = $_POST['cabinaAntiguedad'];
    if($cabinaPeriodo == 1){$tiempoCabina = "day";
    }elseif($cabinaPeriodo == 2){$tiempoCabina = "week";
    }elseif($cabinaPeriodo == 3){$tiempoCabina = "month";
    }elseif($cabinaPeriodo == 4){$tiempoCabina = "year";}
    if($cabina > 0 and $cabinaPeriodo > 0 and $cabinaAntiguedad > 0){
        $queryCabinaUno = "select sum(tc.precio) as cantidad, tc.descripcion as nombre
                           from viaje as v
                                inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                                inner join reserva as r on u.fkCodigoReserva = r.codigo
                                inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                                inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                                inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                                inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                                inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                          where ir.fechaQuePidioReserva between date_sub(now(), interval ".$totalAntiguedad." ".$tiempoCabina.") and now()
                                and c.fkCodigoTipoDeCabina = ".$cabina.";";
    }
    
    if(isset($queryTotalUno) || isset($queryVueloUno) || isset($queryServicioUno) || isset($queryCabinaUno)){
        include('../Vista/adminFacturacionDos.php');
    }else{
        include('../Vista/adminFacturacionTres.php');
    }
}

?>
