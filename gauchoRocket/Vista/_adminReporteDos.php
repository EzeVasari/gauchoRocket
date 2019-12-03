<?php
include('../Modelo/conexion.php');

$resultadoVueloUno = mysqli_query($conexion, $queryVueloUno);  /* VUELO: Cantidad de veces que se reservó | cantidad - nombre */
$resultadoVueloDos = mysqli_query($conexion, $queryVueloDos);  /* VUELO: Cabina más solicitada del vuelo | cantidad - tipoCabina */
$resultadoVueloTres = mysqli_query($conexion, $queryVueloTres);/* VUELO: Servicio más solicitado | cantidad - tipoServicio */

$resultadoServicioUno = mysqli_query($conexion, $queryServicioUno);/* SERVICIO: Cuantas veces se solicitó | cantidad - tipoServicio */
                                                                   /* SERVICIO: Que vuelo más lo solicitó | vuelo */
                                                                   /* SERVICIO: En qué cabinas más se solicitó | tipoCabina */
                                                                   /* SERVICIO: En que equipos más se solicitó | equipoTipo - equipoModelo */

$resultadoCabinaUno = mysqli_query($conexion, $queryCabinaUno);      /* CABINA: Cantidad de veces que fue solicitado | cantidad - tipoCabina */
$resultadoCabinaDos = mysqli_query($conexion, $queryCabinaDos);      /* CABINA: Vuelo que más solicitó la cabina | cantidad - nombre */
$resultadoCabinaTres = mysqli_query($conexion, $queryCabinaTres);    /* CABINA: Servicio más solicitado para la cabina | cantidad - nombre */
$resultadoCabinaCuatro = mysqli_query($conexion, $queryCabinaCuatro);/* CABINA: Equipo en el que más se encuentra la cabina | cantidad - nombre */

$resultadoEquipoUno = mysqli_query($conexion, $queryEquipoUno); /* EQUIPO: Cuantas veces fue utilizado el tipo de equipo | cantidad - modelo - desEquipo */
                                                                /* EQUIPO: En que vuelos más se encuentra | vuelo */
                                                                /* EQUIPO: Con cuántos asientos cuenta | suit - gral - familiar */
                                                                /* EQUIPO: Servicio más utilizado | servi */
?>

<div class='container p-2 mb-5 mt-5 border border-dark'>
    <div class="row justify-content-center">
        
        <?php
        if($periodo == "day"){
            $tiempo = "días";
        }
        if($periodo == "week"){
            $tiempo = "semanas";
        }
        if($periodo == "month"){
            $tiempo = "meses";
        }
        if($periodo == "year"){
            $tiempo = "años";
        }
        echo "<h3 class='font-weight-bold'>Se detallan los reportes de los/as últimos/as ".$antiguedad." ".$tiempo."</h3>";
        ?>
        
        <?php /* === REPORTE VUELVO === */
        $cierre = "NO";
            while($rowVueloUno = mysqli_fetch_assoc($resultadoVueloUno)){
                echo "
                    <div class='col-md-6 text-center mb-3'>
                        <img src='img/admin/reporteVuelo.jpg' class='card-img-top'>
                        <h4 class='font-weight-bold'>Reporte de vuelo ".$rowVueloUno['nombre']."</h4>

                        <p class='text-muted'>
                            El vuelo fue reservado un total de ".$rowVueloUno['cantidad']." veces.
                        </p>
                     ";
            }
            while($rowVueloDos = mysqli_fetch_assoc($resultadoVueloDos)){
                echo "
                        <p class='text-muted'>
                            En este vuelo la cabina más solicitada fue '".$rowVueloDos['tipoCabina']."', la cual fue solicitada ".$rowVueloDos['cantidad']." veces.
                        </p>
                     ";
            }
            while($rowVueloTres = mysqli_fetch_assoc($resultadoVueloTres)){
                echo "
                        <p class='text-muted'>
                            En este vuelo el servicio más solicitado fue '".$rowVueloTres['tipoServicio']."', el cual fue solicitada ".$rowVueloTres['cantidad']." veces.
                        </p>
                     ";
                echo "</div>";
                $cierre = "SI";
            }
        if($cierre == "NO"){
            echo "</div>";
        }
        ?>
        
        <?php /* === REPORTE SERVICIO === */
            while($rowServicioUno = mysqli_fetch_assoc($resultadoServicioUno)){
                echo "
                    <div class='col-md-6 text-center mb-3'>
                        <img src='img/admin/reporteServicio.jpg' class='card-img-top'>
                        <h4 class='font-weight-bold'>Reporte del servicio ".$rowServicioUno['tipoServicio']."</h4>

                        <p class='text-muted'>
                            El servicio fue elegido un total de ".$rowServicioUno['cantidad']." veces.
                        </p>
                        <p class='text-muted'>
                            Este servicio fue solicitado mayormente en el vuelo ".$rowServicioUno['vuelo'].".
                        </p>
                        <p class='text-muted'>
                            Las cabinas que más se vinculan con este servicio es '".$rowServicioUno['tipoCabina']."'.
                        </p>
                        <p class='text-muted'>
                            Los equipos de tipo '".$rowServicioUno['equipoTipo']."' son donde más se solicitó el mismo, siendo los de modelo ".$rowServicioUno['equipoModelo']." donde más se registra este servicio.
                        </p>
                    </div>
                     ";
            }
        ?>
        
        <?php /* === REPORTE CABINA === */
            while($rowCabinaUno = mysqli_fetch_assoc($resultadoCabinaUno)){
                echo "
                        <div class='col-md-6 text-center mb-3'>
                        <img src='img/admin/reporteCabina.jpg' class='card-img-top'>
                        <h4 class='font-weight-bold'>Reporte de la cabina ".$rowCabinaUno['tipoCabina']."</h4>

                        <p class='text-muted'>
                            La cabina fue elegida un total de ".$rowServicioUno['cantidad']." veces.
                        </p>
                     ";
            }
            while($rowCabinaDos = mysqli_fetch_assoc($resultadoCabinaDos)){
                echo "
                        <p class='text-muted'>
                            Esta cabina se encuentra mayormente en el vuelo de ".$rowCabinaDos['nombre'].", siendo elegido ".$rowCabinaDos['cantidad']." veces.
                        </p>
                     ";
            }
            while($rowCabinaTres = mysqli_fetch_assoc($resultadoCabinaTres)){
                echo "
                        <p class='text-muted'>
                            Para este tipo de cabina, los clientes solicitaron, por lo general, el servicio '".$rowCabinaTres['nombre']."', siendo elegido en ".$rowCabinaTres['cantidad']." reservas.
                        </p>
                     ";
            }
            while($rowCabinaCuatro = mysqli_fetch_assoc($resultadoCabinaCuatro)){
                echo "
                        <p class='text-muted'>
                            La cabina en cuestión, tiene una mayor presencia en los equipos '".$rowCabinaCuatro['nombre']."', teniendo presencia en ".$rowCabinaCuatro['cantidad']." de ellos.
                        </p>
                    </div>
                     ";
            }
        ?>
        
        <?php /* === REPORTE EQUIPO === */
            while($rowEquipoUno = mysqli_fetch_assoc($resultadoEquipoUno)){
                echo "
                        <div class='col-md-6 text-center mb-3'>
                        <img src='img/admin/reporteEquipo.jpg' class='card-img-top'>
                        <h4 class='font-weight-bold'>Reporte de equipos ".$rowEquipoUno['desEquipo']."</h4>
                        <p class='text-muted'>
                            Los equipo de tipo '".$rowEquipoUno['desEquipo']."' fue utilizado en reservas ".$rowEquipoUno['cantidad'].", siendo que tiene mayor presencia en los de modelo '".$rowEquipoUno['desEquipo']."'.
                        </p>
                        <p class='text-muted'>
                            Estos tienen mayor presencia en los vuelos '".$rowEquipoUno['vuelo']."'.
                        </p>
                        <p class='text-muted'>
                            Por lo general, estos equipos cuentan con ".$rowEquipoUno['suit']." asientos suite, ".$rowEquipoUno['familiar']." asientos familiares y ".$rowEquipoUno['gral']." asientos de tipo general.
                        </p>
                        <p class='text-muted'>
                            En estos tipo de equipos, se suelen solicitar los servicios ".$rowEquipoUno['servi'].".
                        </p>
                    </div>
                     ";
            }
        ?>
        
    </div>
</div>
