<?php

  include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');


    $matricula = $_GET["matricula"];

    $buscarEquipo = "SELECT * FROM equipo where matricula ='" . $matricula . "'";
  $resultado = mysqli_query($conexion, $buscarEquipo);
  $equipo = mysqli_fetch_assoc($resultado);


   echo'  <br>
   <br>
   <br>
   <br>
   <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">¡Equipo registrado!</h2>
                    <p>El equipo "'.$equipo["modelo"].'" ("'.$matricula.'") fue ingresado al sistema</p>
                    <p class="text-muted">
                        Puede seguir ingresando equipos apretando "Registrar nuevo equipo", si desea salir "Volver a mantenimiento"
                    </p>
                </div>
            </div>';
     
    echo '  <hr>
            <div class="text-center mt-2">
               <a href="adminIndex.php" class="btn btn-secondary">Volver a mantenimiento</a>
                <a href="../Vista/agregarNuevoEquipo.php" class="btn btn-primary  text-white " type="submit" name="ingresar">Registrar nuevo equipo</a>
            </div>';

    ?>