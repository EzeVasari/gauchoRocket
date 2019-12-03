<?php
    
    include("conexion.php");
    
    if(isset($_POST['confirmarCheckin'])){
        
        $codigoReserva = $_GET['reserva'];
        $codigoViaje = $_GET["viaje"];
        
        if(isset($_POST['ubicaciones'])){
            
            $ubicaciones = $_POST['ubicaciones'];
            $cabina= $_GET['cabina'];
            
            $queryLimite = "select count(*) as resultado
                        from relacionClienteItemReserva as rel
	                       inner join itemReserva as ir on rel.fkIdItemReserva = ir.idItemReserva
	                       inner join reserva as r on ir.fkcodigoReserva = r.codigo
                        where r.codigo = '".$codigoReserva."';";
        
            $resultadoLimite = mysqli_query($conexion, $queryLimite);
            $limite = mysqli_fetch_assoc($resultadoLimite);
            
            $queryCabina = "SELECT tdc.descripcion as nombre
                            FROM cabina as c INNER JOIN tipoDeCabina as tdc
                             ON c.fkCodigoTipoDeCabina = tdc.codigoTipoDeCabina
                             WHERE c.codigoCabina =".$cabina;
        
            $resultadoCabina = mysqli_query($conexion, $queryCabina);
            $cabinaNombre = mysqli_fetch_assoc($resultadoCabina);
            
            $queryServicio = "SELECT tds.descripcion as nombre
                            FROM reserva as r INNER JOIN itemReserva as ir 
                                ON ir.fkCodigoReserva = r.codigo
                            INNER JOIN servicio as s
                                ON ir.fkCodigoServicio = s.codigoServicio
                            INNER JOIN tipoDeServicio as tds
                                ON s.fkCodigoTipoDeServicio = tds.codigoTipoDeServicio
                            WHERE r.codigo = '".$codigoReserva."'";
        
            $resultadoServicio = mysqli_query($conexion, $queryServicio);
            $servicio = mysqli_fetch_assoc($resultadoServicio);
            
            if($limite["resultado"] == count($ubicaciones)) {
            
                $queryTrayecto = "SELECT t.fkCodigoLugarOrigen AS origen, t.fkCodigoLugarDestino AS destino, rvt.fkCodigoViaje AS codigoViaje, t.idTrayecto as idTrayecto
                                FROM reserva AS r INNER JOIN relacionReservaTrayecto AS rrt
                                    ON r.codigo = rrt.fkCodigoReserva
                                INNER JOIN trayecto AS t
                                    ON rrt.fkIdTrayecto = t.idTrayecto
                                INNER JOIN relacionViajeTrayecto AS rvt
                                    ON t.idTrayecto = rvt.fkIdTrayecto
                                WHERE r.codigo = '".$codigoReserva."' and rvt.fkCodigoViaje = '".$codigoViaje."'";

                $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

                if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)){

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

                            foreach($ubicaciones as $u){

                                $queryUbicacion = "UPDATE ubicacion as u INNER JOIN trayecto as t
                                                        ON u.fkIdTrayecto = t.idTrayecto
                                                   SET estado = false, nroUbicacion = '".$u."'
                                                   WHERE idTrayecto = ".$trayecto['idTrayecto']." and fkCodigoCabina = ".$cabina." and fkCodigoViaje = ".$codigoViaje." and fkCodigoReserva = '".$codigoReserva."'";

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
                    
                     echo '<br><div class="alert alert-success mt-5" role="alert">
                            ¡Check-in confirmado! Te hemos mandado tu pase de abordaje a '.$_SESSION['user'].' también.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>';
                    
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    
                    $usuario = $_SESSION['user'];
                    
                    //Busqueda Usuario
                    $busquedaUsuario = "SELECT * FROM usuario WHERE email ='" .$_SESSION['user']. "'";
                    $resultadoUsuario = mysqli_query($conexion, $busquedaUsuario);
                    $datos = mysqli_fetch_assoc($resultadoUsuario);
                    
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
                    
                    
                    /* == Envio de email == */
                    $asunto = "Confirmación de checkin | Gaucho Rocket"; 

                    $cuerpo = ' 
                            <!DOCTYPE html>
                            <html lang="es">
                                <head>
                                    <meta charset="utf-8">
                                </head>
                                <body style="font-family: sans-serif !important;">
                                    <div style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; @media (min-width: 576px) { max-width: 540px; }; @media (min-width: 768px) { max-width: 720px;}; @media (min-width: 992px) { max-width: 960px;}; padding: 1.5rem !important; margin-bottom: 0.5rem !important; @page { min-width: 992px !important;}; background-color: #A08DD7 !important; color: #fff !important;">
                                     <div style="display: -ms-flexbox !important; display: flex !important; -ms-flex-pack: center !important; justify-content: center !important;">
                                       <h2>
                                        <img src="http://localhost/gauchoRocket/gauchoRocket/Vista/img/cohete.png" width="25" height="25" alt="">
                                        Gaucho Rocket
                                      </h2>
                                     </div>
                                     <div style="padding: 1rem !important; background-color: #fff !important; color: #343a40 !important;">
                                        <h3 style="text-align: center !important;">Confirmacion de Check-in</h3>
                                        <p>¡Se ha confirmado el check-in de la reserva #<strong>fghdsj3</strong>!</p>
                                        <h5 style ="margin-top: 0.5rem !important; text-align: center; !important"><strong>'.$origen["nombreOrigen"].' - '.$destino["nombreDestino"].'</strong></h5>
                                         <p style ="margin-top: 0.5rem !important;"><strong>Codigo de abordaje:</strong><strong style ="font-size: 24px; !important;"> '.$codigoReserva.'</strong></p>
                                         <p style ="margin-top: 0.5rem !important;"><strong>Cabina:</strong> '.$cabinaNombre["nombre"].'</p>
                                         <p style ="margin-top: 0.5rem !important;"><strong>Servicio:</strong> '.$servicio["nombre"].'</p>
                                        <p style ="margin-top: 0.5rem !important;"><strong>Nombre y apellido:</strong> '.$datos["nombre"].' '.$datos["apellido"].'</p>
                                        <p style ="margin-top: 1rem !important;"><strong>Codigo QR para ingresar en puerta de embarque:</strong></p>
                                        <img  class="border border-primary" src="http://localhost/gauchoRocket/gauchoRocket/Vista/'.$dir.basename($filename).'"/>
                                        <p style="margin-top: 1rem !important;">
                                        Gracias,<br>
                                        El equipo de <span style="font-weight: 700 !important;">Gaucho Rocket</span>.
                                        </p>
                                     </div>
                                    </div>
                                </body>
                            </html>

                            ';

                    $headers = "MIME-Version: 1.0\r\n"; 
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

                    mail($datos["email"],$asunto,$cuerpo,$headers);

                        /* == Fin envio de email == */

                    /*------------------ CODIGO QR ---------------*/

                    echo '
                        <br><div class="col-0-md-7 text-center mt-1">
                                <h2 class="font-weight-bold">Check-in confirmado</h2>
                                <p class="text-muted">Este es su pase de abordaje:</p>
                            </div>
                            <div class="container mt-2">
                              <div class="row justify-content-center">
                                <div class="col-md-5 order-md-2 mb-2">
                                  <ul class="list-group mb-2 border border-primary">
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

                }else {
                 echo '<br><div class="alert alert-warning mt-5" role="alert">
                            No se registró el checkin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>';
                }
                
                }else {
                     echo '<br><div class="alert alert-warning mt-5" role="alert">
                                No se seleccionaron las ubicaciones correspondientes. <a class="alert-link" href="../Vista/checkin.php?reserva='.$codigoReserva.'&viaje='.$codigoViaje.'">Volver a intentarlo</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>';
                }

                }else {
                     echo '<br><div class="alert alert-warning mt-5" role="alert">
                                No se seleccionaron ubicaciones. <a class="alert-link" href="../Vista/checkin.php?reserva='.$codigoReserva.'&viaje='.$codigoViaje.'">Volver a intentarlo</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>';
                }
    }
?>
