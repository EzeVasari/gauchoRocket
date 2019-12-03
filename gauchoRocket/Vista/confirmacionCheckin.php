<?php
  include("head.php");
  include("navbar.php");

?>
               

    <br><div class="col-0-md-7 text-center mt-5">
            <h2 class="font-weight-bold">Check-in confirmado</h2>
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

        </div>