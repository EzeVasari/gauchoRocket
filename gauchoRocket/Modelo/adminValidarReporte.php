<?php
include('conexion.php');

if(isset($_POST["buscar"])){
    $vuelo = $_POST["vuelo"];
    $servicio = $_POST["servicio"];
    $cabina = $_POST["cabina"];
    $equipo = $_POST["equipo"];
    $periodo = $_POST["periodo"];
    $antiguedad = $_POST["antiguedad"];
    
    
    
    if() {
        include('../Vista/adminReporteDos.php');
    }else{          
        include('../Vista/adminReporteDos.php');
    }
}

include('../Vista/adminReporteDos.php');
?>
