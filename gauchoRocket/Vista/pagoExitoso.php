<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    
  if(isset($_GET["reserva"])){
        $codigoReserva = $_GET["reserva"];
        $codigoViaje = $_GET["viaje"];
    }

    $viajePrecioTotal = 0;

    $queryTrayecto = "SELECT t.nombreTrayecto as nombreTrayecto, t.fkCodigoLugarOrigen as origen, t.fkCodigoLugarDestino as destino 
                  FROM reserva AS r 
                  INNER JOIN relacionReservaTrayecto as rrt
                    ON r.codigo = rrt.fkCodigoReserva
                  INNER JOIN trayecto as t
                    On rrt.fkIdTrayecto = t.idTrayecto
                  WHERE r.codigo = '".$codigoReserva."'";
    
    $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);
    $trayecto = mysqli_fetch_assoc($resultadoTrayecto);

    $auxDestino = $trayecto["origen"];

    for ($i = $trayecto["origen"]; $i < $trayecto["destino"]; $i++){
            
        $auxDestino++;

        $buscarTrayecto = "SELECT * 
                           FROM trayecto as t
                           INNER JOIN relacionViajeTrayecto as rvt
                                ON t.idTrayecto = rvt.fkIdTrayecto
                           WHERE t.fkCodigoLugarOrigen =".$i." and t.fkCodigoLugarDestino =".$auxDestino." and fkCodigoViaje =".$codigoViaje."";
        $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

        if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)) {
            
            $queryTrayecto2 = "SELECT t.precio as precio 
                              FROM reserva AS r 
                              INNER JOIN relacionReservaTrayecto as rrt
                                ON r.codigo = rrt.fkCodigoReserva
                              INNER JOIN trayecto as t
                                On rrt.fkIdTrayecto = t.idTrayecto
                              WHERE r.codigo = '".$codigoReserva."'";
    
            $resultadoTrayecto2 = mysqli_query($conexion, $queryTrayecto2);
            $trayecto2 = mysqli_fetch_assoc($resultadoTrayecto2);
            
            $viajePrecioTotal += $trayecto2["precio"];
            
        }   
    }
            $queryServicio = "SELECT tds.precio as precioServicio, tds.descripcion as nombreServicio
                              FROM reserva as r INNER JOIN itemReserva as ir
                                ON r.codigo = ir.fkCodigoReserva
                              INNER JOIN servicio as s
                                ON ir.fkCodigoServicio = s.codigoServicio
                              INNER JOIN tipoDeServicio as tds
                                ON s.fkCodigoTipoDeServicio = tds.codigoTipoDeServicio
                              WHERE r.codigo = '".$codigoReserva."'";
            
            $resultadoServicio = mysqli_query($conexion, $queryServicio);
            
            $servicio = mysqli_fetch_assoc($resultadoServicio);
            

            $queryCabina = "SELECT tdc.precio as precioCabina, tdc.descripcion as nombreCabina
                              FROM reserva as r INNER JOIN itemReserva as ir
                                ON r.codigo = ir.fkCodigoReserva
                              INNER JOIN cabina as c
                                ON ir.fkCodigoCabina = c.codigoCabina 
                              INNER JOIN tipoDeCabina as tdc
                                ON c.fkCodigoTipoDeCabina = tdc.codigoTipoDeCabina
                              WHERE r.codigo = '".$codigoReserva."'";
            
            $resultadoCabina = mysqli_query($conexion, $queryCabina);
            
            $cabina = mysqli_fetch_assoc($resultadoCabina);

            $queryAsientos = "SELECT count(idUbicacion) as personas
                              FROM ubicacion as u INNER JOIN reserva as r
                                ON u.fkCodigoReserva = r.codigo
                              INNER JOIN itemReserva as ir
                                ON r.codigo = ir.fkCodigoReserva
                              WHERE r.codigo = '".$codigoReserva."'";

            $resultadoAsientos = mysqli_query($conexion, $queryAsientos);
            $asientos = mysqli_fetch_assoc($resultadoAsientos);
        
 $precioDeServicio = $servicio["precioServicio"] * $asientos["personas"];
 $precioDeCabina = $cabina["precioCabina"] * $asientos["personas"];
 $precioViaje =  $viajePrecioTotal * $asientos["personas"];
 $precioTotal = $precioDeServicio+ $precioViaje + $precioDeCabina;/* realice esto por que fue lo unico que se me ocurrio en 6 horas pensando y funciono, es probable que sea una blaqueada pero funciono, o eso espero*/

          $query2="UPDATE cliente SET  cliente.montoDeCompras = '".$precioTotal."' WHERE fkEmailUsuario = '".$usuario."'";
           $ingresoTotal = mysqli_query($conexion, $query2); /*actualiza el monto total en la base de datos*/


 echo '<br><div class="col-0-md-7 text-center mt-5">
                <h2 class="font-weight-bold">Su pago ha sido registrado</h2>
                <p class="text-muted">Recuerde que una vez abonado, se habilitara su confirmacion de asistencia en el check-in</p>
            </div>
            <div class="container mt-2">
              <div class="row justify-content-center">
                <div class="col-md-4 order-md-2 mb-2">
                  <ul class="list-group mb-2">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0"><strong>'.$trayecto["nombreTrayecto"].'</strong></h6>
                        <small class="text-muted"> Vuelo completo '.$trayecto["nombreTrayecto"].'</small>
                      </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Vuelo <span class="text-muted">x'.$asientos["personas"].'</span></h6>
                        <small class="text-muted">Monto final de vuelo</small>
                      </div>
                      <span class="text-muted">$'.$precioViaje.'</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Servicio <span class="text-muted">x'.$asientos["personas"].'</span></h6>
                        <small class="text-muted">Monto final del servicio </small>
                      </div>
                      <span class="text-muted">$'.$servicio["precioServicio"].'</span>
                    </li>
                     <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Cabina <span class="text-muted">x'.$asientos["personas"].'</span></h6>
                        <small class="text-muted">El monto de la cabina '.$cabina["nombreCabina"].'</small>
                      </div>
                      <span class="text-muted">$'.$cabina["precioCabina"].'</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (USD)</span>
                      <strong>$'.$precioTotal.'</strong>
                    </li>
                    <li class="list-group-item text-center">
                      <i class="fas fa-check-circle fa-3x text-success"></i>
                    </li>
                  </ul>
                  
                </div>
                
              </div>
              <div class="row justify-content-center">
              <a href="reservasDelCliente.php" class="" >Volver a reservas</a>
              </div>
              
            </div>';

?>
        