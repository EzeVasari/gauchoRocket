<?php
    include("../Vista/head.php");
    include("../Vista/navbar.php");
    
     if(!isset($_SESSION)){
        session_start();
     }
    if(!isset($_SESSION['user'])){
        header("Location: ../Vista/index.php?m=3");
        exit();
    }
    
    
    include("conexion.php");

    function generarCodigoReserva($longitud) {
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
    }
    

    if(isset($_GET["codigo"])) {
    
        $codigo = $_GET["codigo"];
        $usuario = $_SESSION['user'];
        //Busqueda Viaje
        $reserva = "SELECT * FROM viaje as v inner join equipo as e on v.matriculaEquipo = e.matricula WHERE v.codigo = ". $codigo ."";
        
        $resultado = mysqli_query($conexion, $reserva);
        $viaje = mysqli_fetch_assoc($resultado);
        }

        //Busqueda Usuario
        $busquedaUsuario = "SELECT * FROM usuario WHERE email ='" .$_SESSION['user']. "'";
        $resultadoUsuario = mysqli_query($conexion, $busquedaUsuario);
        $datos = mysqli_fetch_assoc($resultadoUsuario);
    
    if(isset($_POST["confirmarReserva"])){
    //Obtener fecha y hora de inicio y límite de check-in
    $fecha = "SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl, DATE_SUB(fecha, INTERVAL 2 DAY) as fi, now() as ahora
                FROM viaje WHERE codigo = ".$codigo.";";
    $resultadoFecha = mysqli_query($conexion, $fecha);
    $fechaDeCheckin = mysqli_fetch_assoc($resultadoFecha);
    
    $codigoReserva =  generarCodigoReserva(6); 
        
    
    if(!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["documentos"]) && !empty($_POST["emails"])){
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $documentos = $_POST["documentos"];
        $emails = $_POST["emails"];
        $servicio = $_POST["servicio"];
        $cabina = $_POST["cabina"];
        $origenTrayecto = $_POST["origenTrayecto"];
        $destinoTrayecto = $_POST["destinoTrayecto"];
        
        $queryTrayecto = "SELECT * FROM trayecto WHERE fkCodigoLugarOrigen = ".$origenTrayecto." and fkCodigoLugarDestino =".$destinoTrayecto;
        $buscarTrayecto = mysqli_query($conexion, $queryTrayecto);
        
        
        if ($trayecto = mysqli_fetch_assoc($buscarTrayecto)) {
            $auxDestino = $origenTrayecto;
            $verifAsientos = true;
            
            for ($i = $origenTrayecto; $i < $destinoTrayecto; $i++){
            
                $auxDestino++;

                $buscarTrayecto = "SELECT * 
                                   FROM trayecto as t
                                   INNER JOIN relacionViajeTrayecto as rvt
                                        ON t.idTrayecto = rvt.fkIdTrayecto
                                   WHERE t.fkCodigoLugarOrigen =".$i." and t.fkCodigoLugarDestino =".$auxDestino." and fkCodigoViaje =".$codigo."";
                $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);
            
                if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)) {
                    $queryAsientos = "SELECT count(idUbicacion) as asientosReservados
                                      FROM ubicacion as u INNER JOIN trayecto as t
	                                   ON u.fkIdTrayecto = t.idTrayecto
                                      WHERE fkCodigoCabina = ".$cabina." and fkCodigoViaje = ".$codigo." and t.fkCodigoLugarOrigen =".$i."
                                        and t.fkCodigoLugarDestino =".$auxDestino."";
                    
                    $resultadoAsientos = mysqli_query($conexion, $queryAsientos);
                    $asientos = mysqli_fetch_assoc($resultadoAsientos);
                    
                    if($cabina ==  1){
                        $asientosCabina = $viaje["capacidadGeneral"];
                    }elseif ($cabina ==  2){
                        $asientosCabina = $viaje["capacidadFamiliar"];
                    }else {
                        $asientosCabina = $viaje["capacidadSuit"];
                    }
                    
                    if(($asientosCabina - $asientos["asientosReservados"]) >= count($emails)){
                        $verifAsientos = true;
                    }else {
                        $verifAsientos = false;
                    }
                }
                
                if(!$verifAsientos) {
                    break;
                }
            
            }

                $queryReserva = "INSERT INTO reserva (codigo) VALUES ('".$codigoReserva."')";
                $registroReserva = mysqli_query($conexion, $queryReserva);

                $idItemReserva = rand(1000,8000);

                if($fechaDeCheckin['ahora'] > $fechaDeCheckin['fi'] || !$verifAsientos){
                    $queryItemReserva = "INSERT INTO itemReserva (idItemReserva, fkCodigoReserva, fkCodigoServicio, fkCodigoCabina, checkin, pago, fechaLimiteDeCheckin, fechaInicioDeCheckin, fechaConfirmacion, fechaQuePidioReserva, listaDeEspera) VALUES
                    (".$idItemReserva.",'".$codigoReserva."', ". $servicio .", ". $cabina .", false, false, '".$fechaDeCheckin['fl']."', '".$fechaDeCheckin['fi']."', null, '".$fechaDeCheckin['ahora']."', true);";
                }else{
                    $queryItemReserva = "INSERT INTO itemReserva (idItemReserva, fkCodigoReserva, fkCodigoServicio, fkCodigoCabina, checkin, pago, fechaLimiteDeCheckin, fechaInicioDeCheckin, fechaConfirmacion, fechaQuePidioReserva, listaDeEspera) VALUES
                    (".$idItemReserva.",'".$codigoReserva."', ". $servicio .", ". $cabina .", false, false, '".$fechaDeCheckin['fl']."', '".$fechaDeCheckin['fi']."', null, '".$fechaDeCheckin['ahora']."', false);";
                    
                    for($i= 0; $i < count($emails); $i++){
                        $guardarUbicacion = "INSERT INTO ubicacion (estado,fkCodigoViaje, fkIdTrayecto, fkCodigoCabina, fkCodigoReserva) VALUES
                        (false, ".$codigo.", ".$trayecto['idTrayecto'].", ".$cabina.", '".$codigoReserva."')";
                        $resultadoGuardar = mysqli_query($conexion, $guardarUbicacion);   
                    }
                }

                $registro = mysqli_query($conexion, $queryItemReserva);

                $i = 0;
                foreach($emails as $e) {
                    $queryUsuario = "SELECT * FROM usuario WHERE email ='".$e."'";
                    $resultadoEmail = mysqli_query($conexion, $queryUsuario);

                    if(mysqli_fetch_assoc($resultadoEmail)){
                        $queryRelacion = "INSERT INTO relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente, fecha) VALUES (".$idItemReserva.", '".$e."', now())";

                        $queryRelacionTrayecto = "INSERT INTO relacionReservaTrayecto (fkCodigoReserva, fkIdTrayecto) VALUES ('".$codigoReserva."', ".$trayecto["idTrayecto"].")";
                        

                        $registroClienteItemReserva = mysqli_query($conexion, $queryRelacion);
                        $registroReservaTrayecto = mysqli_query($conexion, $queryRelacionTrayecto);

                    }else {
                        
                        $codigoHash = md5(rand(0,1000));

                        $query = "INSERT INTO usuario (email, dni, rol, nombre, apellido, codigoHash, active) VALUES('".$e."','".$documentos[$i]."',false,'".$nombres[$i]."','".$apellidos[$i]."', '".$codigoHash."', false)";
                        $queryDos = "INSERT INTO cliente (fkEmailUsuario) VALUES ('".$e."')";

                        $insert = mysqli_query($conexion, $query);
                        $insertDos = mysqli_query($conexion, $queryDos);

                        $queryRelacion = "INSERT INTO relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente, fecha) VALUES (".$idItemReserva.", '".$e."', now())";
                        $registroClienteItemReserva = mysqli_query($conexion, $queryRelacion);

                        /* == Envio de email == */
                        $asunto = "Confirmación de cuenta | Gaucho Rocket"; 

                        $cuerpo = ' 
                                <!DOCTYPE html>
                                <html lang="">
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
                                        <p>Hola:</p>
                                        <p>¡Han registrado una reserva que contiene tu email en Gaucho Rocket!</p>
                                        <p style ="margin-top: 0.5rem !important;">Por favor, haga click en el enlace de la parte inferior para confirmar su dirección de correo electrónico. Una vez que confirme su correo electrónico, puede comenzar a utilizar nuestro servicio.</p>
                                        <div style="display: -ms-flexbox !important; display: flex !important; -ms-flex-pack: center !important; justify-content: center !important;">
                                            <a href="http://localhost/gauchoRocket/gauchoRocket/Vista/verificacionEmailReserva.php?email='.$e.'&hash='.$codigoHash.'" role="button" style="display: inline-block; font-weight: 400; color: #212529; text-align: center; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-color: transparent; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; color: #fff; background-color: #AD84C7 !important; border-color: #AD84C7 !important; text-decoration: none !important;">Confirmar cuenta</a>
                                        </div>
                                        <p style="margin-top: 0.5rem !important;">
                                        Gracias,<br>
                                        El equipo de <span style="font-weight: 700 !important;">Gaucho Rocket</span>.
                                        </p>
                                        <p style="font-style: italic !important;">
                                        Si no puede ver el botón de confirmación de arriba, aquí tiene el enlace de confirmación: http://localhost/gauchoRocket/gauchoRocket/Vista/verificacionEmailReserva.php?email='.$e.'&hash='.$codigoHash.'
                                        </p>
                                     </div>
                                    </div>
                                </body>

                                </html>

                                ';

                        $headers = "MIME-Version: 1.0\r\n"; 
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

                        mail($e,$asunto,$cuerpo,$headers);

                        /* == Fin envio de email == */
                    }
                    $i++;
                }
                if($registroClienteItemReserva){
                    if($fechaDeCheckin['ahora'] > $fechaDeCheckin['fi'] || !$verifAsientos){
                        echo '<br><div class="alert alert-success mt-5" role="alert">
                                Usted se encuentra en lista de espera. Será informado...
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>';
                    }else{
                        echo '<br><div class="alert alert-success mt-5" role="alert">
                                Se confirmó la reserva. <a class="alert-link" href="../Vista/reservasDelCliente.php">Pagar reserva</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>';
                    }
                
                $query = "SELECT ir.fkCodigoReserva AS codigo, time(v.fecha) as hora, date(v.fecha) as fecha, v.imagen AS img, v.nombre AS nombre,              v.descripcion AS descripcion,               v.precio AS precio
                  FROM relacionClienteItemReserva AS rcr
                  INNER JOIN itemReserva AS ir 
                    ON rcr.fkIdItemReserva = ir.idItemReserva
                  INNER JOIN Reserva AS r 
                    ON ir.fkCodigoReserva = r.codigo
                  INNER JOIN Viaje AS v 
                    ON v.codigo = ".$codigo."
                  WHERE ir.idItemReserva ='".$idItemReserva."'";
                
                $resultadoReserva = mysqli_query($conexion, $query);

                if($reserva = mysqli_fetch_assoc($resultadoReserva)){

                    echo "<div class='container mt-5'> 
                            <div class='card mb-3' style='max-width: 840px;'>
                              <div class='row no-gutters justify-content-center'>
                                <div class='col-md-4'>
                                  <img src='../Vista/".$reserva['img']."' class='card-img'>
                                </div>
                                <div class='col-md-8'>
                                  <div class='card-body'>
                                    <h5 class='card-title'>".$reserva['nombre']." (".$reserva['codigo'].")</h5>
                                    <div class'row'>
                                        <p>".$reserva['descripcion']."</p>
                                    </div>
                                    <div class'row mt-4'>
                                        <div class'col'>
                                            <p class='card-text'><span class='font-weight-bold'>Fecha:</span> ".$reserva['fecha']."</p>
                                        </div>
                                        <div class'col'>
                                            <p class='card-text'><span class='font-weight-bold'>Hora:</span> ".$reserva['hora']."</p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>";       
                }
                
                } else {
                    echo '<br><div class="alert alert-warning mt-5" role="alert">
                                No se confirmó la reserva.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>';
                }
                }else {
                    echo '<br><div class="alert alert-warning mt-5" role="alert">
                                Trayecto inválido.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </div>'; 
                }
    }else {
        echo '<br><div class="alert alert-warning mt-5" role="alert">
                    Hay campos vacíos!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    }
        
    }
    
?>









