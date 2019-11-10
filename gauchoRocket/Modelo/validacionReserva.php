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
    $reserva = "SELECT * FROM viaje WHERE codigo = " . $codigo ."";
    $resultado = mysqli_query($conexion, $reserva);
    $viaje = mysqli_fetch_assoc($resultado);
    }
    
    //Busqueda Usuario
    $busquedaUsuario = "SELECT * FROM usuario WHERE email ='" .$_SESSION['user']. "'";
    $resultadoUsuario = mysqli_query($conexion, $busquedaUsuario);
    $datos = mysqli_fetch_assoc($resultadoUsuario);
    
    if(isset($_POST["confirmarReserva"])){
    //Obtener fecha y hora limite
    $fecha = "SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl FROM viaje WHERE codigo = ".$codigo; //Fecha límite
    $resultadoFecha = mysqli_query($conexion, $fecha);
    $fechaLimite = mysqli_fetch_assoc($resultadoFecha);
    
    $codigoReserva =  generarCodigoReserva(6); 
    
    if(!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["documentos"]) && !empty($_POST["emails"])){
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $documentos = $_POST["documentos"];
        $emails = $_POST["emails"];
        $servicio = $_POST["servicio"];
        $cabina = $_POST["cabina"];
        
        $queryReserva = "INSERT INTO reserva (codigo, codigoViaje) VALUES ('".$codigoReserva."',".$codigo.")";
        $registroReserva = mysqli_query($conexion, $queryReserva);
        
        $idItemReserva = rand(1000,8000);
       
        
        $queryItemReserva = "INSERT INTO itemReserva(idItemReserva, fkCodigoReserva, checkin, pago, fechaLimite, fechaConfirmacion, fkCodigoServicio, fkCodigoCabina) VALUES (".$idItemReserva.",'".$codigoReserva."', false, false, '".$fechaLimite['fl']."', null, ". $servicio .", ". $cabina .")";
        $registro = mysqli_query($conexion, $queryItemReserva);
        
        
        $i = 0;
        foreach($emails as $e) {
            $queryUsuario = "SELECT * FROM usuario WHERE email ='".$e. "'";
            $resultadoEmail = mysqli_query($conexion, $queryUsuario);
            
            if(mysqli_fetch_assoc($resultadoEmail)){
                $queryRelacion = "INSERT INTO relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente) VALUES (".$idItemReserva.", '".$e."')";
                
                $registro = mysqli_query($conexion, $queryRelacion);
             
            }else {
                $i++;
                $codigoHash = md5(rand(0,1000));
              
                $query = "INSERT INTO usuario (email, dni, rol, nombre, apellido, codigoHash, active) VALUES('".$e."','".$documentos[$i]."',false,'".$nombres[$i]."','".$apellidos[$i]."', '".$codigoHash."', false)";
                $queryDos = "INSERT INTO cliente (fkEmailUsuario) VALUES ('".$e."')";
            
                $insert = mysqli_query($conexion, $query);
                $insertDos = mysqli_query($conexion, $queryDos);
                
                $queryRelacion = "INSERT INTO relacionClienteItemReserva (fkIdItemReserva, fkEmailCliente) VALUES (".$idItemReserva.", '".$e."')";
                $registro = mysqli_query($conexion, $queryRelacion);
                
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
        }
        
    if($registro){
        echo '<br><div class="alert alert-success mt-5" role="alert">
                    Se confirmó la reserva. <a class="alert-link" href="../Vista/reservasDelCliente.php">Pagar reserva</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        
        $query = "SELECT ir.fkCodigoReserva AS codigo, time(v.fecha) as hora, date(v.fecha) as fecha, v.imagen AS img, v.nombre AS nombre, v.descripcion AS descripcion, v.precio AS precio
                FROM relacionClienteItemReserva AS rcr INNER JOIN itemReserva AS ir
                    ON rcr.fkIdItemReserva = ir.idItemReserva
                INNER JOIN Reserva AS r
                    ON ir.fkCodigoReserva = r.codigo
                INNER JOIN Viaje AS v
                    ON r.codigoViaje = v.codigo
                WHERE ir.idItemReserva ='".$idItemReserva."'";
                
        $resultadoReserva = mysqli_query($conexion, $query);
                
        if($reserva = mysqli_fetch_assoc($resultadoReserva)){
            
            echo "<div class='container mt-5'> 
                    <div class='card mb-3' style='max-width: 840px;'>
                      <div class='row no-gutters justify-content-md-center'>
                        <div class='col-md-4'>
                          <img src='../Vista/".$reserva['img']."' class='card-img'>
                        </div>
                        <div class='col-md-8'>
                          <div class='card-body'>
                            <h5 class='card-title'>".$reserva['nombre']." - (".$reserva['codigo'].")</h5>
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
                    Hay campos vacíos!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    }

}
    
?>









