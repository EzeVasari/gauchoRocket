<!DOCTYPE html>
<html>
<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: index.php");
        exit();
    }
    
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    include('../Modelo/validarPaginasParaAdministradores.php');
    
    
?>

</html>

