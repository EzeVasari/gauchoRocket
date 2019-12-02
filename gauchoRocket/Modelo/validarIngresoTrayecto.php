<?php
include('conexion.php');

$codigoVuelo= $_GET["vuelo"];
$idTrayecto = $_POST["trayecto"];
$precio= $_POST["precio"];
$duracion= $_POST["duracion"];

/*$query1 = "insert into trayecto (idTrayecto, nombreTrayecto, precio, duracion, fkCodigoLugarOrigen, fkCodigoLugarDestino)
        values('".$idTrayecto."', '".$nombreTrayecto."', '".$precio."', '".$duracion."', null, null)";


$insert1 = mysqli_query($conexion, $query1);


$query2 = "UPDATE trayecto SET fkcodigoLugarOrigen='".$origen."'   
        where idTrayecto='".$idTrayecto."'";
    
        $insert2 = mysqli_query($conexion, $query2);

$query3 = " UPDATE trayecto SET fkcodigoLugarDestino='".$destino."' 
        where idTrayecto='".$idTrayecto."'";
    
        $insert3 = mysqli_query($conexion, $query3);*/


         
 	    $query4 ="insert into relacionviajetrayecto (fkIdTrayecto,fkCodigoViaje)
        values('".$idTrayecto."','".$codigoVuelo."')";
         $insert4 = mysqli_query($conexion, $query4);


      

 if($insert4 == TRUE )
 {
 	   
          header('location:../Vista/ingresoTrayectoValido.php?vuelo='.$codigoVuelo.'&codigoTrayecto='.$idTrayecto.'');
 }else
 {
 	echo "no salio";
 }


?>