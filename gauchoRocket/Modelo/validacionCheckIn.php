<?php
if(isset($_POST['valida'])){
    $codigReser = $_POST['codigoDeLaReserva'];
    
    $queryUpdate = "update itemReserva set checkin = true where idItemReserva = ".$codigReser.";";
    $resultadoUpdate = mysqli_query($conexion, $queryUpdate);
    
    if($resultadoUpdate){
        header("Location: ../Vista/index.php?m=7");
    }else{
        header("Location: ../Vista/index.php?m=8");
    }
}

?>
