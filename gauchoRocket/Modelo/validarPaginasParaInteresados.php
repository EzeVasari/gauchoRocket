<?php
include('conexion.php');
session_start();

if(isset($_SESSION['user'])) {
    
$usuario = $_SESSION['user'];

$consulta = "SELECT rol FROM usuario WHERE email like '".$usuario."'";
$resultado = mysqli_query($conexion, $consulta);

while($row = mysqli_fetch_assoc($resultado)){
    if($row['rol'] == true){
        header('Location: ../Vista/adminIndex.php?m=4');
    }
}
    
}

?>
