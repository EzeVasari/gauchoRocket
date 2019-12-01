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
    
/* =========================== CANTIDAD DE VECES QUE SE RESERVÓ =========================== */
    $queryVueloUno = "select count(v.codigo) as cantidad
                      from viaje as v
                        inner join relacionViajeTrayecto as relu on v.codigo = relu.fkCodigoViaje
                        inner join trayecto as t on relu.fkIdTrayecto = t.idTrayecto
                        inner join relacionReservaTrayecto as reld on t.idTrayecto = reld.fkIdTrayecto
                        inner join reserva as r on reld.fkCodigoReserva = r.codigo
                        inner join itemReserva as ir on r.codigo = ir.fkcodigoReserva
                      where ir.fechaQuePidioReserva between date_sub(now(), interval ".$antiguedad." ".$periodo.") and now()
                        and v.codigo = ".$vuelo.";";
    $resultadoVueloUno = mysqli_query($conexion, $queryVueloUno);
    
/* =========================== CABINA MÁS SAOLICITADA DEL VUELO ========================== */
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
    $resultadoVueloDos = mysqli_query($conexion, $queryVueloDos);
    
/* =========================== CANTIDAD DE VECES QUE SE RESERVÓ =========================== */
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
    $resultadoVueloTres = mysqli_query($conexion, $queryVueloTres);
/* ======================================================================================== */
/* ======================================== VUELOS ======================================== */
/* ======================================================================================== */
    
    
    
/* ========================================================================================================================================================= */
    
    
    
/* ======================================================================================== */
/* ======================================== CABINAS ======================================= */
/* ======================================================================================== */
    $queryCabinaUno = "";
    $resultadoCabinaUno = ;
    
    $queryCabinaDos = "";
    $resultadoCabinaDos = ;
    
    $queryCabinaTres = "";
    $resultadoCabinaTres = ;
/* ======================================================================================== */
/* ======================================== CABINAS ======================================= */
/* ======================================================================================== */
    
    
    
    
    
    
    /*
    if() {
        include('../Vista/adminReporteDos.php');
    }else{
        include('../Vista/adminReporteDos.php');
    }*/
}

include('../Vista/adminReporteDos.php');
?>
