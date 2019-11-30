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
$img =  $_FILES['img']['name'];



	

	$buscarVuelo = "SELECT * FROM viaje where codigo ='" . $codigoVuelo . "' or nombre = '". $nombreVuelo ."'";
	$resultado = mysqli_query($conexion, $buscarVuelo);
        
    $count = mysqli_num_rows($resultado);
    $directorio="";
    if($count == 1){
        header("location: ../Vista/adminMantenimiento.php");
    }else {


            if($_FILES["img"]["error"] > 0){
            echo "Error: " . $_FILES["img"]["error"] . "<br />";
            }   else{
                    echo "Upload: " . $_FILES["img"]["name"] . "<br />";
                    echo "Type: " . $_FILES["img"]["type"] . "<br />";
                    echo "Size: " . ($_FILES["img"]["size"] / 1024) . " Kb<br />";
                    echo "Stored in: " . $_FILES["img"]["tmp_name"];

                    if(file_exists("../Vista/img/" . $_FILES["img"]["name"])){
                        echo $_FILES["img"]["name"] . " ya existe. ";
                        } else{
                            move_uploaded_file($_FILES["img"]["tmp_name"],
                            "../Vista/img/" . $_FILES["img"]["name"]);
                            echo "Almacenado en: " . "../Vista/img/" . $_FILES["img"]["name"];
                            }
                }

                 $directorio = "img/".$_FILES["img"]["name"];



            


        $query1 = "insert into viaje (codigo, imagen, descripcion, precio, nombre)
        values('".$codigoVuelo."', '".$directorio."', '".$descripcion."',
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
        echo 'ingreso valido';
      echo  $directorio;
    }else {
        echo "error";
      
echo $directorio;

        }
    }
    
    


?>