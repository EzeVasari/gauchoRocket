<?php

include("conexion.php");


$modeloEquipo = $_POST["modelo"];
$matricula= $_POST["matricula"];
$capacidadSuit = $_POST["Suit"];
$capacidadGeneral = $_POST["general"];
$capacidadFamiliar = $_POST["familiar"];

$nivel = $_POST["nivel"];




	

	$buscarEquipo = "SELECT * FROM equipo where matricula ='" . $matricula . "' or modelo = '". $modeloEquipo ."'";
	$resultado = mysqli_query($conexion, $buscarEquipo);
        
    $count = mysqli_num_rows($resultado);
    $directorio="";
    if($count == 1){
        header("location: ../Vista/adminMantenimientoIndex.php");
    }else {


        $query1 = "insert into equipo (matricula, modelo, capacidadSuit, capacidadFamiliar, capacidadGeneral)
        values('".$matricula."', '".$modeloEquipo."', '".$capacidadSuit."',
                    '".$capacidadFamiliar."', '".$capacidadGeneral."')";
    
        $insert1 = mysqli_query($conexion, $query1);

$query2 = "UPDATE equipo SET fkcodigoTipoDeEquipo='".$nivel."'   
        where matricula='".$matricula."'";
    
        $insert2 = mysqli_query($conexion, $query2);




    if($insert1 == TRUE && $insert2==TRUE ){
      header('Location: ../Vista/ingresoEquipoValido.php?matricula='.$matricula.'');
    }else {
        echo "error";
      
echo $directorio;

        }
    }
    
    


?>