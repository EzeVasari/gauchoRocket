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
    $busquedaUsuario = "SELECT * FROM usuario WHERE nick ='" .$_SESSION['user']. "'";
    $resultadoUsuario = mysqli_query($conexion, $busquedaUsuario);
    $datos = mysqli_fetch_assoc($resultadoUsuario);
    
    if(isset($_POST["pagar"])){
    //Obtener fecha y hora limite
    $fecha = "SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl FROM viaje WHERE codigo = ".$codigo; //Fecha límite
    $resultadoFecha = mysqli_query($conexion, $fecha);
    $fechaLimite = mysqli_fetch_assoc($resultadoFecha);
    
    $codigoReserva =  generarCodigoReserva(6);  
    
    $queryReserva = "INSERT INTO reserva (codigo,codigoViaje) VALUES ('".$codigoReserva."',".$codigo.")";
    $registroReserva = mysqli_query($conexion, $queryReserva);
        
    $insert = "INSERT INTO relacionClienteReserva(codigoReserva, codigoCliente, checkin, pago, fechaLimite, fechaConfirmacion) VALUES
            ('".$codigoReserva."', '".$_SESSION['user']."', false, false, '".$fechaLimite['fl']."', null);
          ";
    $registro = mysqli_query($conexion, $insert);
    
    if($registro && $registroReserva){
        echo '<br><div class="alert alert-success mt-5" role="alert">
                    Se confirmó la reserva. <a class="alert-link" href="../Vista/pago.php">Pagar reserva</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    
    } else {
        '<br><div class="alert alert-warning mt-5" role="alert">
                    No se confirmó la reserva.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    }
}
    
?>









