<?php

  include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');


    $idTrayecto = $_GET["codigoTrayecto"];
    $codigoVuelo= $_GET["vuelo"];

    $buscar = "SELECT t.nombreTrayecto as nombreTrayecto, v.nombre as nombreVuelo
                    FROM viaje as v INNER JOIN relacionViajeTrayecto as rvt
                        ON v.codigo = rvt.fkCodigoViaje
                    INNER JOIN trayecto as t
                        ON rvt.fkIdTrayecto = t.idTrayecto
                    WHERE v.codigo =".$codigoVuelo." and t.idTrayecto =".$idTrayecto;

    $resultado = mysqli_query($conexion, $buscar);
    $fila = mysqli_fetch_assoc($resultado);


   echo'  
        <div class="row justify-content-center mt-5">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Trayecto ingresado satifactoriamente</h2>
                    <p>El trayecto "'.$fila["nombreTrayecto"].'" fue cargado en el viaje "'.$fila["nombreVuelo"].'"</p>
                    <p class="text-muted">
                        Puede seguir ingresando trayectos apretando "Registrar nuevo trayecto", si desea salir "Finalizar"
                    </p>
                </div>
            </div>';
     echo ' <hr>
            <div class="text-center mt-2">
               <a href="adminIndex.php" class="btn btn-secondary">Finalizar</a>
                <a  href="../Vista/ingresarTrayectos.php?viaje='.$codigoVuelo.'" class="btn btn-primary text-white" name="ingresar">Registrar nuevo trayecto</a>
            </div>
            
     ';

    ?>