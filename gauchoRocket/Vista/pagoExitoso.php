<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');

  if(isset($_GET["reserva"])){
        $codigoReserva = $_GET["reserva"];
    }

       $query="SELECT v.descripcion, v.imagen as img, t.nombre, tdc.descripcion as nombreCabina, count(rci.fkIdItemReserva) AS personas, tdc.precio AS precioServicio, t.precio AS precioViaje, tdc.precio AS precioCabina 
           from viaje as v inner join relacionViajeTrayecto as rvt on
v.codigo= rvt.fkCodigoViaje inner join trayecto as t on 
t.idTrayecto = rvt.fkIdTrayecto inner join relacionReservaTrayecto
as rrt on rrt.fkIdTrayecto =t.idTrayecto inner join reserva as r
on r.codigo = rrt.fkCodigoReserva inner join  itemReserva as ir on
ir.fkcodigoReserva= r.codigo inner join tipoDeServicio as tds on
 ir.fkCodigoServicio = tds.codigoTipoDeServicio inner join tipoDeCabina 
 as tdc on tdc.codigoTipoDeCabina= ir.fkCodigoCabina
 inner join relacionClienteItemReserva as rci on rci.fkIdItemReserva = ir.idItemReserva
            WHERE ir.fkCodigoReserva='".$codigoReserva."'";

 $precio = mysqli_query($conexion, $query);
 $datos = mysqli_fetch_assoc($precio);

    
 $precioDeServicio = $datos["precioServicio"] * $datos["personas"];
 $precioDeCabina = $datos["precioCabina"] * $datos["personas"];
 $precioViaje = $datos["precioViaje"] * $datos["personas"];
 $precioTotal = $precioDeServicio+ $precioViaje + $precioDeCabina;

 $resultado = mysqli_query($conexion, $query);

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
                        <h6 class="my-0"><strong>'.$datos["nombre"].'</strong></h6>
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
                    <li class="list-group-item text-center">
                      <i class="fas fa-check-circle fa-3x text-success"></i>
                    </li>
                  </ul>
                </div>
              </div>
            </div>';

?>
        