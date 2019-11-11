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

    $query="select v.descripcion, v.nombre, count(rci.fkIdItemReserva) as personas, s.precio as precioServicio, v.precio as precioViaje, tdc.precio as precioCabina from viaje as v inner join reserva as r on v.codigo = r.codigoViaje inner join itemreserva as i on i.fkCodigoReserva = r.codigo inner join servicio as s on s.codigoServicio= i.fkCodigoServicio inner join relacionclienteitemreserva as rci on i.idItemReserva = rci.fkIdItemReserva inner join cabina as c on i.fkCodigoCabina = c.codigoCabina inner join tipodecabina as tdc on c.fkCodigoTipoDeCabina = tdc.codigoTipoDeCabina 
    where i.fkCodigoReserva='".$codigoReserva."'";
$precio = mysqli_query($conexion, $query);
 $datos = mysqli_fetch_assoc($precio);


$precioDeServicio= $datos["precioServicio"] * $datos["personas"];
$precioDeCabina= $datos["precioCabina"] * $datos["personas"];
$precioViaje= $datos["precioViaje"] * $datos["personas"];
 $precioTotal=$precioDeServicio+ $precioViaje + $precioDeCabina;/* realice esto por que fue lo unico que se me ocurrio en 6 horas pensando y funciono, es probable que sea una blaqueada pero funciono, o eso espero*/


  echo'<script type="text/javascript">
    $(function () {
      $("[data-toggle="tooltip"]").tooltip();
    })
</script>
<br>
<br>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center">
        <span class="text-muted"><strong>Compra</strong></span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">"'.$datos["nombre"].'"</h6>
            <small class="text-muted">"'.$datos["descripcion"].'"</small>
          </div>
          <span class="text-muted">"Precio Total $'.$precioTotal.'"</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">viaje</h6>
            <small class="text-muted">Precio del Viaje </small>
          </div>
          <span class="text-muted">"$'.$datos["precioViaje"].'"</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Servicio</h6>
            <small class="text-muted">El monto del servicio por Persona</small>
          </div>
          <span class="text-muted">"$'.$datos["precioServicio"].'"</span>
        </li>
         <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Cabina</h6>
            <small class="text-muted">El monto de la Cabina por Persona</small>
          </div>
          <span class="text-muted">"$'.$datos["precioCabina"].'"</span>
        </li>
        <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (USD)</span>
          <strong>$20</strong>
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