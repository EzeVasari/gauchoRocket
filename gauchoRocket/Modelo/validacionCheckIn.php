<?php
    
    include("conexion.php");
    
    if(isset($_POST['confirmarCheckin'])){
        
        $codigoReserva = $_GET['reserva'];
        $codigoViaje = $_GET["viaje"];
        
        if(isset($_POST['ubicaciones'])){
            
            $ubicaciones = $_POST['ubicaciones'];
            $cabina= $_GET['cabina'];
            
            
            foreach($_POST['ubicaciones'] as $u){
            
             echo $u;
            }

            $queryTrayecto = "SELECT t.fkCodigoLugarOrigen AS origen, t.fkCodigoLugarDestino AS destino, rvt.fkCodigoViaje AS codigoViaje, t.idTrayecto as idTrayecto
                            FROM reserva AS r INNER JOIN relacionReservaTrayecto AS rrt
                                ON r.codigo = rrt.fkCodigoReserva
                            INNER JOIN trayecto AS t
                                ON rrt.fkIdTrayecto = t.idTrayecto
                            INNER JOIN relacionViajeTrayecto AS rvt
                                ON t.idTrayecto = rvt.fkIdTrayecto
                            WHERE r.codigo = '".$codigoReserva."'";

            $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

            if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)){

                $auxDestino = $trayecto["origen"];

                for ($i = $trayecto["origen"]; $i < $trayecto["destino"]; $i++){

                    $auxDestino++;

                    $buscarTrayecto = "SELECT * 
                                       FROM trayecto as t
                                       INNER JOIN relacionViajeTrayecto as rvt
                                            ON t.idTrayecto = rvt.fkIdTrayecto
                                       WHERE t.fkCodigoLugarOrigen =".$i." and t.fkCodigoLugarDestino =".$auxDestino." and fkCodigoViaje =".$trayecto["codigoViaje"]."";

                    $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

                    if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)) {

                        foreach($ubicaciones as $u){

                            $queryUbicacion = "UPDATE ubicacion as u INNER JOIN trayecto as t
                                                    ON u.fkIdTrayecto = t.idTrayecto
                                               SET estado = false, nroUbicacion = ".$u."
                                               WHERE idTrayecto = ".$trayecto['idTrayecto']." and fkCodigoCabina = ".$cabina." and fkCodigoViaje = ".$trayecto["codigoViaje"]." and fkCodigoReserva = '".$codigoReserva."'";
                            
                            $resultadoUbicacion = mysqli_query($conexion, $queryUbicacion);    
                        }    
                    }
                }    
            }
            
            $queryItem = "UPDATE itemReserva as ir INNER JOIN reserva as r
                            ON ir.fkCodigoReserva = r.codigo
                          SET checkin = true
                          WHERE r.codigo = '".$codigoReserva."'";
                            
            $resultadoitem = mysqli_query($conexion, $queryItem);

            if($resultadoUbicacion) {
                $queryTrayecto = "SELECT t.nombreTrayecto as nombreTrayecto, t.fkCodigoLugarOrigen as codigoOrigen, t.fkCodigoLugarDestino as codigoDestino
                  FROM reserva AS r 
                  INNER JOIN relacionReservaTrayecto as rrt
                    ON r.codigo = rrt.fkCodigoReserva
                  INNER JOIN trayecto as t
                    ON rrt.fkIdTrayecto = t.idTrayecto
                  WHERE r.codigo = '".$codigoReserva."'";
    
                $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);
                $trayecto = mysqli_fetch_assoc($resultadoTrayecto);
                
                $queryOrigen = "SELECT l.nombre as nombreOrigen 
                  FROM lugar as l 
                  WHERE l.codigo =".$trayecto["codigoOrigen"];

                $resultadoOrigen = mysqli_query($conexion, $queryOrigen);
                $origen = mysqli_fetch_assoc($resultadoOrigen);


                $queryDestino = "SELECT l.nombre as nombreDestino 
                              FROM lugar as l 
                              WHERE l.codigo =".$trayecto["codigoDestino"];

                $resultadoDestino = mysqli_query($conexion, $queryDestino);
                $destino = mysqli_fetch_assoc($resultadoDestino);

                function generarCodigoAbordaje($longitud) {
                    $key = '';
                    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                    $max = strlen($pattern)-1;
                    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
                    return $key;
                }

                $codigoAbordaje = generarCodigoAbordaje(5);

                $queryViaje = "SELECT time(v.fecha) as horaSalida, date(v.fecha) as fecha, v.fecha as fechaHora
                              FROM viaje as v 
                              WHERE v.codigo =".$codigoViaje;

                $resultadoViaje = mysqli_query($conexion, $queryViaje);
                $viaje = mysqli_fetch_assoc($resultadoViaje);


             /*------------------ CODIGO QR ---------------*/
                //Agregamos la libreria para genera códigos QR
                require "../help/phpqrcode/qrlib.php";    

                //Declaramos una carpeta temporal para guardar la imagenes generadas
                $dir = 'img/qr/';

                //Si no existe la carpeta la creamos
                if (!file_exists($dir))
                    mkdir($dir);

                    //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.$codigoReserva.'.png';

                    //Parametros de Condiguración

                $tamanio = 10; //Tamaño de Pixel
                $level = 'L'; //Precisión Baja
                $framSize = 3; //Tamaño en blanco
                $contenido = $codigoReserva; //Texto

                    //Enviamos los parametros a la Función para generar código QR 
                QRcode::png($contenido, $filename, $level, $tamanio, $framSize); 

                /*------------------ CODIGO QR ---------------*/
                
                echo '
                    <br><div class="col-0-md-7 text-center mt-5">
                            <h2 class="font-weight-bold">Check-in confirmado</h2>
                            <p class="text-muted">Este es su pase de abordaje:</p>
                        </div>
                        <div class="container mt-2">
                          <div class="row justify-content-center">
                            <div class="col-md-5 order-md-2 mb-2">
                              <ul class="list-group mb-2">
                                <li class="list-group-item lh-condensed">
                                  <div>
                                    <h3 class="my-0 text-center"><strong>'.$origen["nombreOrigen"].'  <i class="fas fa-space-shuttle"></i>  '.$destino["nombreDestino"].'</strong></h3>
                                  </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h5 class="my-0"><strong>Código abordaje</strong></h5>
                                    <small class="text-muted">Deberá presentarlo al momento de abordar</small>
                                  </div>
                                  <h4 class="font-weight-bold">'.$codigoAbordaje.'</h4>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h6 class="my-0">Abordaje</h6>
                                    <small class="text-muted">Horario de salida </small>
                                  </div>
                                  <span class="text-muted">'.$viaje["horaSalida"].'</span>
                                </li>
                                 <li class="list-group-item d-flex justify-content-between lh-condensed">
                                  <div>
                                    <h6 class="my-0">Fecha</h6>
                                    <small class="text-muted">Fecha de salida</small>
                                  </div>
                                  <span class="text-muted">'.$viaje["fecha"].'</span>
                                </li>
                                <li class="list-group-item text-center">
                                  <img  class="border border-primary" src="'.$dir.basename($filename).'"/><hr/>
                                </li>
                              </ul>

                            </div>

                          </div>
                          <div class="row justify-content-center">
                          <a href="reservasDelCliente.php" class="mb-3" >Volver a reservas</a>
                          </div>

                        </div>';

            } 

        }else {
             echo '<br><div class="alert alert-warning mt-5" role="alert">
                        No se seleccionaron ubicaciones. <a class="alert-link" href="../Vista/checkin.php?reserva=".$codigoReserva."&viaje=".$codigoViaje."">Volver a intentarlo</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>';
        }
    }
?>
