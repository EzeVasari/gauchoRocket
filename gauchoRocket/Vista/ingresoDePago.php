<?php
 session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');

	if(isset($_GET["codigo"])){
        $codigoReserva = $_GET["codigo"];
    }

	echo'<script type="text/javascript">
    $(function () {
      $("[data-toggle="tooltip"]").tooltip();
    })
</script>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center">
        <span class="text-muted"><strong>Compra</strong></span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Product name</h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$12</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Second product</h6>
            <small class="text-muted">Brief description</small>
          </div>
          <span class="text-muted">$8</span>
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