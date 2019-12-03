<?php

include("conexion.php");


$nombreTrayecto = $_POST["nombreTrayecto"];
$IdTrayecto= $_POST["IdTrayecto"];
$duracion = $_POST["duracion"];
$precio = $_POST["precio"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$img =  $_FILES['img']['name'];



	

	$buscarVuelo = "SELECT * FROM trayecto where IdTrayecto ='" . $IdTrayecto . "'";
	$resultado = mysqli_query($conexion, $buscarVuelo);
        
    $count = mysqli_num_rows($resultado);
    $directorio="";
    if($count == 1){
        header("location: ../Vista/adminMantenimientoIndex.php");
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



            


        $query1 = "insert into trayecto (idTrayecto, nombreTrayecto, precio, duracion, imagen)
        values('".$IdTrayecto."', '".$nombreTrayecto."', '".$precio."',
                    '".$duracion."', '".$directorio."')";
    
        $insert1 = mysqli_query($conexion, $query1);

$query2 = "UPDATE trayecto SET fkCodigoLugarOrigen='".$origen."'   
        where idTrayecto='".$IdTrayecto."'";
    
        $insert2 = mysqli_query($conexion, $query2);

$query3 = " UPDATE trayecto SET fkCodigoLugarDestino='".$destino."' 
        where idTrayecto='".$IdTrayecto."'";
    
        $insert3 = mysqli_query($conexion, $query3);   

    
       


    if($insert1 == TRUE && $insert2==TRUE && $insert3==true){
      header('Location: ../Vista/registroTrayectoValido.php?trayecto='.$IdTrayecto.'');
    }else {
        echo "error";
      
echo $directorio;

        }
    }
    
    


?>