<?php
include('conexion.php');

$codigoVuelo= $_GET["vuelo"];
$nombreTrayecto= $_POST["nombreTrayecto"];
$idTrayecto = $_POST["codigoTrayecto"];
$precio= $_POST["precio"];
$duracion= $_POST["duracion"];
$origen= $_POST["origen"];
$destino= $_POST["destino"];

$query1 = "insert into trayecto (idTrayecto, nombreTrayecto, precio, duracion)
        values('".$idTrayecto."', '".$nombreTrayecto."', '".$precio."', '".$duracion."')";


$insert1 = mysqli_query($conexion, $query1);


$query2 = "UPDATE trayecto SET fkcodigoLugarOrigen='".$origen."'   
        where idTrayecto='".$idTrayecto."'";
    
        $insert2 = mysqli_query($conexion, $query2);

$query3 = " UPDATE trayecto SET fkcodigoLugarDestino='".$destino."' 
        where idTrayecto='".$idTrayecto."'";
    
        $insert3 = mysqli_query($conexion, $query3);   

 if($insert1 == TRUE)
 {
 	echo "";
 }else
 {
 	echo "no salio";
 }


?>