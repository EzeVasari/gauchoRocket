<?php
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
    include('../Modelo/registroUsuarios.php');
    include('registroUsuarios.php');
    
    include('../Modelo/conexion.php');
    $query="select * from viaje";
    $resultado=mysqli_query($conexion, $query);
    echo'<br>';
    include('cards.php');
         
        


  
    
    
?>