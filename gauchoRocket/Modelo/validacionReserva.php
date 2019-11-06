<?php
    include("../Vista/head.php");
    include("../Vista/navbar.php");

     session_start();
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
    
    if(!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["documentos"])){
        
        $queryReserva = "INSERT INTO reserva (codigo, codigoViaje) VALUES ('".$codigoReserva."',".$codigo.")";
        $registroReserva = mysqli_query($conexion, $queryReserva);
        
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $documentos = $_POST["documentos"];
        $emails = $_POST["emails"];
        $servicio = $_POST["servicio"];
        $cabina = $_POST["cabina"];
        $i = 0;
        foreach($emails as $e) {
            $queryUsuario = "SELECT * FROM usuario WHERE email ='".$e. "'";
            $resultadoEmail = mysqli_query($conexion, $queryUsuario);
            
            if(mysqli_fetch_assoc($resultadoEmail)){
                $insert = "INSERT INTO itemReserva(fkCodigoReserva, fkEmailCliente, checkin, pago, fechaLimite, fechaConfirmacion, fkCodigoServicio, fkCodigoCabina) VALUES ('".$codigoReserva."', '".$e."', false, false, '".$fechaLimite['fl']."', null, ". $servicio .", ". $cabina .")";
                
                $registro = mysqli_query($conexion, $insert);
                
            
                /* == PRUEBA, IGNORAR == 
                $asunto = "Confirmacion de su Registro de reserva"; 

                $cuerpo = ' 
                <html> 
                <head> 
                   <title>Prueba de correo</title> 
                </head> 
                <body> 
                <h1>Estimado Usuario!</h1> 
                <p> 
                <b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
                </p> 
                </body> 
                </html> 
                ';
                
                $headers = "MIME-Version: 1.0\r\n"; 
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
                

                mail($e,$asunto,$cuerpo,$headers);
                    

                if (mail($e,$asunto,$cuerpo,$headers)) {
                    echo "<br><br><br><br><br><br>SIIIII";
                }
                == PRUEBA, IGNORAR == */

            }else {
                $i++;
                $query = "INSERT INTO usuario (email, dni, rol, nombre, apellido) VALUES ('".$e."','".$documentos[$i]."',false,'".$nombres[$i]."','".$apellidos[$i]."')";
                $queryDos = "INSERT INTO cliente (fkEmailUsuario) VALUES ('".$e."')";
    
                $insert = mysqli_query($conexion, $query);
                $insertDos = mysqli_query($conexion, $queryDos);
                
                $insert = "INSERT INTO itemReserva(fkCodigoReserva, fkEmailCliente, checkin, pago, fechaLimite, fechaConfirmacion, fkCodigoServicio, fkCodigoCabina) VALUES ('".$codigoReserva."', '".$e."', false, false, '".$fechaLimite['fl']."', null, ". $servicio .", ". $cabina .")";
                
                $registro = mysqli_query($conexion, $insert);
                
                $hashEmail = generarCodigoReserva(10);
            }  
        }
        
    
    if($registro){
        echo '<br><div class="alert alert-success mt-5" role="alert">
                    Se confirmó la reserva. <a class="alert-link" href="../Vista/pago.php">Pagar reserva</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    
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









