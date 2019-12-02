<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');




    if(isset($_GET["codigo"])){
        $codigoReserva = $_GET["codigo"];
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



  echo'<br><br><div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center">
                <span class="text-muted"><strong>Compra</strong></span>
              </h4>
              <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">'.$trayecto["nombreTrayecto"].'</h6>
                    <small class="text-muted">Vuelo completo '.$trayecto["nombreTrayecto"].'</small>
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Vuelo <span class="text-muted">x'.$asientos["personas"].'</span></h6>
                    <small class="text-muted">Monto final de vuelo</small>
                  </div>
                  <span class="text-muted">$'.$viajePrecioTotal.'</span>
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
              </ul>

              <form class="card p-2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Codigo promocional">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary btn-md my-0 ml-0">Aplicar</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-5 order-md-1">
              <h4 class="mb-2"><strong>Pago</strong></h4>
              <div class="card">
                  <div class="card-body">
                      <form role="form" action="../Modelo/validarTarjeta.php?reserva='.$codigoReserva.'" method="post">
                        <div class="form-group">
                        <label for="username">Nombre de titular</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre que figura en la tarjeta" required>
                      </div> <!-- form-group.// -->

                        <div class="form-group">
                        <label for="cardNumber">Numero de tarjeta</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nroTarjeta" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp;
                                    <i class="fab fa-cc-mastercard"></i>
                                </span>
                            </div>
                        </div> <!-- input-group.// -->
                        </div> <!-- form-group.// -->

                        <div class="row">
                            <div class="col-sm-8">
                              <div class="form-group">
                                <label><span class="hidden-xs">Vencimiento</span></label>
                                <div class="input-group">
                                  <input type="number" placeholder="MM" name="mm" class="form-control" required>
                                  <input type="number" placeholder="YY" name="yy" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group mb-4">
                                <label data-toggle="tooltip" title="3 digitos en el reverso de la tarjeta">CVV <i class="fa fa-question-circle"></i></label>
                                <input type="number" name="cvv" class="form-control" required>
                              </div>
                            </div>
                        </div> <!-- row.// -->

                        <button class="btn btn-primary btn-block" type="submit" name="confirmarPago"><i class="fas fa-lock"></i> Confirmar</button>

                    </form>
              </div> <!-- card-body.// -->
            </div>
            </div>
          </div>

          <footer class="mt-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2019 Company Name</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a href="#">Privacy</a></li>
              <li class="list-inline-item"><a href="#">Terms</a></li>
              <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
          </footer>
        </div>';




?>