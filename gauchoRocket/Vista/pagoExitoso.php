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

       $query="SELECT v.descripcion,v.imagen as img, v.nombre, tdc.descripcion as nombreCabina, COUNT(rci.fkIdItemReserva) AS personas, s.precio AS precioServicio, v.precio AS precioViaje, tdc.precio AS precioCabina 
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
 $precioTotal = $precioDeServicio+ $precioViaje + $precioDeCabina;


 echo "<br><br><br><br>

 <div class='col-0-md-7 text-center mb-3'>
             <h2 class='font-weight-bold'>Su Pago Ha sido Registrado</h2>
             <p class='text-muted'>Recuerde que una vez abonado, se habilitara su confirmacion de asistencia en el check-in</p>
         </div>
 				<div class='col mb-4'>
 						<br>	
                            <div class='card reservas text-center mx-auto'>
                                <img src='".$datos['img']."' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$datos['nombre']." (#".$codigoReserva.")</h5>
                                    <p class='card-text'>".$datos['descripcion']."</p>
                                    <h5 class='card-title'>Monto  Total abonado</h5>
                                    <p class='card-text'>$".$precioTotal."</p>
                                </div>
                            </div>
                        </div>         
                        ";

?>