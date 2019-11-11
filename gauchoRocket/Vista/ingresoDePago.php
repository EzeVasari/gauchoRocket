<?php
 session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');

  if(isset($_GET["reserva"])){
        $codigoReserva = $_GET["reserva"];
    }

    $query="SELECT v.descripcion, v.nombre, tdc.descripcion as nombreCabina, COUNT(rci.fkIdItemReserva) AS personas, s.precio AS precioServicio, v.precio AS precioViaje, tdc.precio AS precioCabina 
            FROM viaje AS v 
            INNER JOIN reserva AS r 
                ON v.codigo = r.codigoViaje 
            INNER JOIN itemreserva AS i 
                ON i.fkCodigoReserva = r.codigo 
            INNER JOIN servicio AS s 
                ON s.codigoServicio= i.fkCodigoServicio 
            INNER JOIN relacionclienteitemreserva AS rci 
                ON i.idItemReserva = rci.fkIdItemReserva 
            INNER JOIN cabina AS c 
                ON i.fkCodigoCabina = c.codigoCabina 
            INNER JOIN tipodecabina AS tdc 
                ON c.fkCodigoTipoDeCabina = tdc.codigoTipoDeCabina 
            WHERE i.fkCodigoReserva='".$codigoReserva."'";

 $precio = mysqli_query($conexion, $query);
 $datos = mysqli_fetch_assoc($precio);


 $precioDeServicio = $datos["precioServicio"] * $datos["personas"];
 $precioDeCabina = $datos["precioCabina"] * $datos["personas"];
 $precioViaje = $datos["precioViaje"] * $datos["personas"];
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
                    <h6 class="my-0">'.$datos["nombre"].'</h6>
                    <small class="text-muted">'.$datos["descripcion"].'</small>
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Vuelo <span class="text-muted">x'.$datos["personas"].'</span></h6>
                    <small class="text-muted">Monto final de vuelo</small>
                  </div>
                  <span class="text-muted">$'.$datos["precioViaje"].'</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Servicio <span class="text-muted">x'.$datos["personas"].'</span></h6>
                    <small class="text-muted">Monto final del servicio </small>
                  </div>
                  <span class="text-muted">$'.$datos["precioServicio"].'</span>
                </li>
                 <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Cabina <span class="text-muted">x'.$datos["personas"].'</span></h6>
                    <small class="text-muted">El monto de la cabina '.$datos["nombreCabina"].'</small>
                  </div>
                  <span class="text-muted">$'.$datos["precioCabina"].'</span>
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
                                <input type="text" name="cvv" class="form-control" required>
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