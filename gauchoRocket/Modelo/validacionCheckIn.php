<?php
 include("conexion.php");

if(isset($_POST['valida'])){
    $codigReserva = $_GET['reserva'];
    
    
    $queryUpdate = "UPDATE itemReserva SET checkin = 1 where idItemReserva = ".$codigReserva."";
    $resultadoUpdate = mysqli_query($conexion, $queryUpdate);
    
    
    
    if($resultadoUpdate){
        header("Location: ../Vista/index.php?m=7");
    }else{
       header("Location: ../Vista/index.php?m=8");
    }
}

?>
