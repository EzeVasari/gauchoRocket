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
    
    if(isset($_POST["confirmarReserva"])){
    //Obtener fecha y hora limite
    $fecha = "SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl FROM viaje WHERE codigo = ".$codigo; //Fecha límite
    $resultadoFecha = mysqli_query($conexion, $fecha);
    $fechaLimite = mysqli_fetch_assoc($resultadoFecha);
    
    $codigoReserva =  generarCodigoReserva(6); 
    
    if(!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["documentos"])){
        
        $queryReserva = "INSERT INTO reserva (codigo,codigoViaje) VALUES ('".$codigoReserva."',".$codigo.")";
        $registroReserva = mysqli_query($conexion, $queryReserva);
        
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $documentos = $_POST["documentos"];
        $nicks = $_POST["nicks"];
        
        foreach($nicks as $n) {
            $queryUsuario = "SELECT * FROM usuario WHERE nick ='".$n. "'";
            $resultadoNick = mysqli_query($conexion, $queryUsuario);
            
            if(mysqli_fetch_assoc($resultadoNick)){
                $insert = "INSERT INTO relacionClienteReserva(codigoReserva, codigoCliente, checkin, pago, fechaLimite, fechaConfirmacion) VALUES
                ('".$codigoReserva."', '".$n."', false, false, '".$fechaLimite['fl']."', null);
              ";
                $registro = mysqli_query($conexion, $insert);
            }else {
                 echo '<br><div class="alert alert-warning mt-5" role="alert">
                    El usuario '. $n .' no está registrado.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
            }  
        }
        
    
    if($registro && $registroReserva){
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
        
    }

}
    
?>









