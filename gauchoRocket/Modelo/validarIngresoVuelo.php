<?php

include("conexion.php");


$nombreVuelo = $_POST["nombreVuelo"];
$codigoVuelo= $_POST["codigoVuelo"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$fecha = $_POST["fecha"];


$origen = $_POST["origen"];
$destino = $_POST["destino"];
$nivel = $_POST["nivel"];
$nave = $_POST["nave"];




	

	$buscarVuelo = "SELECT * FROM viaje where codigo ='" . $codigoVuelo . "' or nombre = '". $nombreVuelo ."'";
	$resultado = mysqli_query($conexion, $buscarVuelo);
        
    $count = mysqli_num_rows($resultado);
    $directorio="";
    if($count == 1){
        header("location: ../Vista/adminMantenimientoIndex.php");
    }else {

        $query1 = "insert into viaje (codigo, descripcion, precio, nombre)
        values('".$codigoVuelo."', '".$descripcion."',
                    '".$precio."', '".$nombreVuelo."')";
    
        $insert1 = mysqli_query($conexion, $query1);

$query2 = "UPDATE viaje SET codigoLugarOrigen='".$origen."'   
        where codigo='".$codigoVuelo."'";
    
        $insert2 = mysqli_query($conexion, $query2);

$query3 = " UPDATE viaje SET codigoLugarDestino='".$destino."' 
        where codigo='".$codigoVuelo."'";
    
        $insert3 = mysqli_query($conexion, $query3);   

        $query4 = " UPDATE viaje SET codigoTipoDeViaje='".$nivel."' 
        where codigo='".$codigoVuelo."'";
    
        $insert4 = mysqli_query($conexion, $query4);   

        $query5 = " UPDATE viaje SET matriculaEquipo='".$nave."' 
        where codigo='".$codigoVuelo."'";
    
        $insert5 = mysqli_query($conexion, $query5);     

        $query6 = " UPDATE viaje SET fecha='".$fecha."' 
        where codigo='".$codigoVuelo."'";
    
        $insert6 = mysqli_query($conexion, $query6); 


    if($insert1 == TRUE && $insert2==TRUE && $insert3==true && $insert4==true
    && $insert5 == true &&  $insert6==true ){
      header('Location: ../Vista/ingresarTrayectos.php?viaje='.$codigoVuelo.'');
    }else {
        echo "error";
      
echo $directorio;

        }
    }
    
    


?>