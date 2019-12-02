<?php
include('../Modelo/conexion.php');
?>

<div class='container p-2 mb-5 mt-5 border border-dark'>
    <div class="row justify-content-center">
        
        <?php
        /* FACTURACIÓN TOTAL */
        if(isset($queryTotalUno)){
            if($totalPeriodo == 1){$tiempo = "días";
            }elseif($totalPeriodo == 2){$tiempo = "semanas";
            }elseif($totalPeriodo == 3){$tiempo = "meses";
            }elseif($totalPeriodo == 4){$tiempo = "años";}
            $resultadoTotalUno = mysqli_query($conexion, $queryTotalUno);
            while($rowTotalUno = mysqli_fetch_assoc($resultadoTotalUno)){
                $precioTotal = 0;
                $precioTotal += $rowTotalUno['sumaViaje'];
                $precioTotal += $rowTotalUno['sumaServicio'];
                $precioTotal += $rowTotalUno['sumaCabina'];
                echo "
                    <div class='col-md-6 text-center mb-3'>
                    <h3 class='font-weight-bold'>Total facturado</h3>
                        <img src='img/admin/facturacionTotal.jpg' class='card-img-top'>
                        <h5 class='font-weight-bold'>Tiempo: Últimos ".$totalAntiguedad." ".$tiempo."</h5>
                        <h4 class='font-weight-bold'>u$ ".$precioTotal."</h4>
                    </div>
                     ";
            }
        }
        
        /* FACTURACIÓN VUELO */
        if(isset($queryVueloUno)){
            if($vueloPeriodo == 1){$tiempo = "días";
            }elseif($vueloPeriodo == 2){$tiempo = "semanas";
            }elseif($vueloPeriodo == 3){$tiempo = "meses";
            }elseif($vueloPeriodo == 4){$tiempo = "años";}
            $resultadoVueloUno = mysqli_query($conexion, $queryVueloUno);
            while($rowVueloUno = mysqli_fetch_assoc($resultadoVueloUno)){
                $precioVuelo = $rowVueloUno['cantidad'];
                echo "
                    <div class='col-md-6 text-center mb-3'>
                    <h3 class='font-weight-bold'>Total facturado en viaje ".$rowVueloUno['nombre']."</h3>
                        <img src='img/admin/facturacionViaje.jpg' class='card-img-top'>
                        <h5 class='font-weight-bold'>Tiempo: Últimos ".$vueloAntiguedad." ".$tiempo."</h5>
                        <h4 class='font-weight-bold'>u$ ".$precioVuelo."</h4>
                    </div>
                     ";
            }
        }
        
        /* FACTURACIÓN SERVICIO */
        if(isset($queryServicioUno)){
            if($servicioPeriodo == 1){$tiempo = "días";
            }elseif($servicioPeriodo == 2){$tiempo = "semanas";
            }elseif($servicioPeriodo == 3){$tiempo = "meses";
            }elseif($servicioPeriodo == 4){$tiempo = "años";}
            $resultadoServicioUno = mysqli_query($conexion, $queryServicioUno);
            while($rowServicioUno = mysqli_fetch_assoc($resultadoServicioUno)){
                $precioServicio = $rowServicioUno['cantidad'];
                echo "
                    <div class='col-md-6 text-center mb-3'>
                    <h3 class='font-weight-bold'>Total facturado en servicios ".$rowServicioUno['nombre']."</h3>
                        <img src='img/admin/facturacionServicio.jpg' class='card-img-top'>
                        <h5 class='font-weight-bold'>Tiempo: Últimos ".$servicioAntiguedad." ".$tiempo."</h5>
                        <h4 class='font-weight-bold'>u$ ".$precioServicio."</h4>
                    </div>
                     ";
            }
        }
        
        /* FACTURACIÓN CABINA */
        if(isset($queryCabinaUno)){
            if($cabinaPeriodo == 1){$tiempo = "días";
            }elseif($cabinaPeriodo == 2){$tiempo = "semanas";
            }elseif($cabinaPeriodo == 3){$tiempo = "meses";
            }elseif($cabinaPeriodo == 4){$tiempo = "años";}
            $resultadoCabinaUno = mysqli_query($conexion, $queryCabinaUno);
            while($rowCabinaUno = mysqli_fetch_assoc($resultadoCabinaUno)){
                $precioCabina = $rowCabinaUno['cantidad'];
                echo "
                    <div class='col-md-6 text-center mb-3'>
                    <h3 class='font-weight-bold'>Total facturado en cabinas ".$rowCabinaUno['nombre']."</h3>
                        <img src='img/admin/facturacionCabina.jpg' class='card-img-top'>
                        <h5 class='font-weight-bold'>Tiempo: Últimos ".$cabinaAntiguedad." ".$tiempo."</h5>
                        <h4 class='font-weight-bold'>u$ ".$precioCabina."</h4>
                    </div>
                     ";
            }
        }
        ?>
        
    </div>
</div>
