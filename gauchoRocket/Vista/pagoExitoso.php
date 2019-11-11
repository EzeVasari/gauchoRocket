<?php
 session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');

  if(isset($_GET["reserva"])){
        $codigoReserva = $_GET["reserva"];
    }

    echo $codigoReserva;


?>