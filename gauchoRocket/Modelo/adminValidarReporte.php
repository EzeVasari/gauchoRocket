<?php
include('conexion.php');

if(isset($_POST["buscar"])){
    $vuelo = $_POST["vuelo"];
    $servicio = $_POST["servicio"];
    $cabina = $_POST["cabina"];
    $equipo = $_POST["equipo"];
    $periodo = $_POST["periodo"];
    $antiguedad = $_POST["antiguedad"];
    
/* ======================================================================================== */
/* ======================================== VUELOS ======================================== */
/* ======================================================================================== */
    /* Cantidad de veces que se reservó */
    $queryVueloUno = "select count(v.codigo) as cantidad, v.nombre as nombre
                      from viaje as v
                        inner join relacionViajeTrayecto as relu on v.codigo = relu.fkCodigoViaje
                        inner join trayecto as t on relu.fkIdTrayecto = t.idTrayecto
                        inner join relacionReservaTrayecto as reld on t.idTrayecto = reld.fkIdTrayecto
                        inner join reserva as r on reld.fkCodigoReserva = r.codigo
                        inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                      where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                        and v.codigo = ".$vuelo.";";
    /*$resultadoVueloUno = mysqli_query($conexion, $queryVueloUno);*/
    
    /* Cabina más solicitada del vuelo */
    $queryVueloDos = "select count(c.codigoCabina) as cantidad, t.descripcion as tipoCabina
                      from viaje as v
                        inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                        inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                        inner join tipoDeCabina as t on c.fkCodigoTipoDeCabina = t.codigoTipoDeCabina
                        inner join reserva as r on u.fkCodigoReserva = r.codigo
                        inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                      where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                        and v.codigo = ".$vuelo."
                      group by c.codigoCabina
                      order by cantidad desc
                      LIMIT 1";
    /*$resultadoVueloDos = mysqli_query($conexion, $queryVueloDos);*/
    
    /* Servicio más solicitado */
    $queryVueloTres = "select count(ir.fkCodigoServicio) as cantidad, ts.descripcion as tipoServicio
                       from viaje as v
                            inner join relacionViajeTrayecto as relu on v.codigo = relu.fkCodigoViaje
                            inner join trayecto as t on relu.fkIdTrayecto = t.idTrayecto
                            inner join relacionReservaTrayecto as reld on t.idTrayecto = reld.fkIdTrayecto
                            inner join reserva as r on reld.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                       where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and v.codigo = ".$vuelo."
                       group by ir.fkCodigoServicio
                       order by cantidad desc
                       LIMIT 1";
    /*$resultadoVueloTres = mysqli_query($conexion, $queryVueloTres);*/
/* ======================================================================================== */
/* ======================================== VUELOS ======================================== */
/* ======================================================================================== */
    
    
    
/* ========================================================================================================================================================= */
    
    
    
/* ======================================================================================== */
/* ======================================= SERVICIO ======================================= */
/* ======================================================================================== */
    /* Cuantas veces se solicitó */
    /* Que vuelo más lo solicitó */
    /* En qué cabinas más se solicitó */
    /* En que equipos más se solicitó */
    $queryServicioUno = "select count(s.fkcodigoTipoDeServicio) as cantidad, v.nombre as vuelo, tc.descripcion as tipoCabina,
	                        te.descripcion as equipoTipo, e.modelo as equipoModelo, ts.descripcion as tipoServicio
                         from servicio as s
                            inner join itemReserva as ir on s.codigoServicio = ir.fkCodigoServicio
                            inner join reserva as r on ir.fkcodigoReserva = r.codigo
                            inner join ubicacion as u on r.codigo = u.fkCodigoReserva
                            inner join viaje as v on u.fkCodigoViaje = v.codigo
                            inner join cabina as c on u.fkCodigoCabina = c.codigoCabina
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join equipo as e on v.matriculaEquipo = e.matricula
                            inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                       where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and s.fkcodigoTipoDeServicio = ".$servicio."
                         group by s.fkcodigoTipoDeServicio
                         order by cantidad desc
                         LIMIT 1;";
    /*$resultadoServicioUno = mysqli_query($conexion, $queryServicioUno);*/
/* ======================================================================================== */
/* ======================================= SERVICIO ======================================= */
/* ======================================================================================== */
    
    
    
/* ========================================================================================================================================================= */
    
    
    
/* ======================================================================================== */
/* ======================================== CABINAS ======================================= */
/* ======================================================================================== */
/* CANTIDAD DE VECES QUE FUE SOLICITADO */
    $queryCabinaUno = "select count(c.fkCodigoTipoDeCabina) as cantidad
                       from cabina as c
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                       where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and c.fkCodigoTipoDeCabina = ".$cabina."
                       group by c.fkCodigoTipoDeCabina;";
    /*$resultadoCabinaUno = mysqli_query($conexion, $queryCabinaUno);*/
    
/* VUELO QUE MÁS SOLICITÓ LA CABINA */    
    $queryCabinaDos = "select count(v.codigo) as cantidad, v.nombre as nombre
                       from cabina as c
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join viaje as v on u.fkCodigoViaje = v.codigo
                       where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and c.fkCodigoTipoDeCabina = ".$cabina."
                       group by v.codigo
                       order by cantidad desc
                       LIMIT 1;";
    /*$resultadoCabinaDos = mysqli_query($conexion, $queryCabinaDos);*/
    
/* SERVICIO MÁS SOLICITADO PARA LA CABINA */ 
    $queryCabinaTres = "select count(s.codigoServicio) as cantidad, ts.descripcion as nombre
                        from cabina as c
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join servicio as s on ir.fkCodigoServicio = s.codigoServicio
                            inner join tipoDeServicio as ts on s.fkcodigoTipoDeServicio = ts.codigoTipoDeServicio
                        where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and c.fkCodigoTipoDeCabina = ".$cabina."
                        group by s.codigoServicio
                        order by cantidad desc
                        LIMIT 1;";
    /*$resultadoCabinaTres = mysqli_query($conexion, $queryCabinaTres);*/
    
/* EQUIPO EN EL QUE MÁS SE ENCUENTRA LA CABINA */
    $queryCabinaCuatro = "select count(e.fkcodigoTipoDeEquipo) as cantidad, te.descripcion as nombre
                        from cabina as c
                            inner join tipoDeCabina as tc on c.fkCodigoTipoDeCabina = tc.codigoTipoDeCabina
                            inner join ubicacion as u on c.codigoCabina = u.fkCodigoCabina
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                            inner join viaje as v on u.fkCodigoViaje = v.codigo
                            inner join equipo as e on v.matriculaEquipo = e.matricula
                            inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
                        where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and c.fkCodigoTipoDeCabina = ".$cabina."
                        group by e.fkcodigoTipoDeEquipo
                        order by cantidad desc
                        LIMIT 1;";
    /*$resultadoCabinaCuatro = mysqli_query($conexion, $queryCabinaCuatro);*/
/* ======================================================================================== */
/* ======================================== CABINAS ======================================= */
/* ======================================================================================== */
    
    
    
/* ========================================================================================================================================================= */
    
    
    
/* ======================================================================================== */
/* ======================================== EQUIPO ======================================== */
/* ======================================================================================== */
    /* Cuantoas veces fue utilizado el tipo de equipo */
    /* En que vuelos más se encuentra*/
    /* Con cuántos asientos cuenta*/
    /* Servicio más utilizado*/
    $queryEquipoUno = "select count(v.matriculaEquipo) as cantidad, e.modelo as modelo, v.nombre as vuelo,
                            e.capacidadSuit as suit, e.capacidadGeneral as gral, e.capacidadFamiliar as familiar,
                            ts.descripcion as servi
                       from equipo as e
                            inner join tipoDeEquipo as te on e.fkcodigoTipoDeEquipo = te.codigo
                            inner join viaje as v on e.matricula = v.matriculaEquipo
                            inner join ubicacion as u on v.codigo = u.fkCodigoViaje
                            inner join reserva as r on u.fkCodigoReserva = r.codigo
                            inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                       where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                            and e.fkcodigoTipoDeEquipo = ".$equipo."
                       group by e.matricula
                       order by cantidad desc
                       LIMIT 1;";
    /*$resultadoCabinaCuatro = mysqli_query($conexion, $queryCabinaCuatro);*/
/* ======================================================================================== */
/* ======================================== EQUIPO ======================================== */
/* ======================================================================================== */
    
    
    
    
    
    /*if($resultadoVueloUno || $resultadoVueloDos || $resultadoVueloTres || $resultadoServicioUno || $resultadoCabinaUno || $resultadoCabinaDos || $resultadoCabinaTres || $resultadoCabinaCuatro || $resultadoEquipoUno)*/
    if($vuelo != 0 || $servicio != 0 || $cabina != 0 || $equipo != 0 and $periodo and $antiguedad){
        /*echo "HOLA";*/
        include('../Vista/adminReporteDos.php');
    }else{
        /*echo "CHAU";*/
        include('../Vista/adminReporteTres.php');
    }
}

?>
