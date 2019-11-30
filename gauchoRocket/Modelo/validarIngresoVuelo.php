<?php

include("conexion.php");


$nombreVuelo = $_POST["nombreVuelo"];
$codigoVuelo= $_POST["codigoVuelo"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["fecha"];
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
                            $directorio = "../Vista/img/" . $_FILES["img"]["name"];
                            }
                }


        $query = "insert into viaje (codigo, imagen, descripcion, precio, nombre, fecha, codigoLugarOrigen, codigoLugarDestino, codigoTipoDeViaje, matriculaEquipo)
                    ('".$codigoVuelo."', '".$directorio."', '".$descripcion."',
                    '".$precio."', '".$nombreVuelo."', '".$fecha."', '".$origen."','".$destino."', '".$nivel."', '".$nave."')";
    
        $insert = mysqli_query($conexion, $query);
    if($insert == TRUE){
        echo 'ingreso valido';
    }else {
        echo "mal";
        }
    }
    


?>