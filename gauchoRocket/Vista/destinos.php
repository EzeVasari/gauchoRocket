<?php
    
    include('head.php');
    include('navbar.php');
    
    
    include('../Modelo/conexion.php');
    $query="SELECT t.imagen as imagen, v.descripcion as descripcion, t.precio as precio, v.codigo as codigo, t.nombreTrayecto as nombre
                FROM trayecto as t INNER JOIN relacionViajeTrayecto as rvt
                    ON t.idTrayecto = rvt.fkIdTrayecto
                INNER JOIN viaje as v
                    ON rvt.fkCodigoViaje = v.codigo";
    
    $resultado=mysqli_query($conexion, $query);
    
    echo'<br>';
    include('cards.php');
         
        


  
    
    
?>