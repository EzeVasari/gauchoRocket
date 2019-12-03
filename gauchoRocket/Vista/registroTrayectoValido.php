<?php

  include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');


    $idTrayecto = $_GET["trayecto"];

    $buscarTrayecto = "SELECT * FROM trayecto where idTrayecto ='" . $idTrayecto . "'";
  $resultado = mysqli_query($conexion, $buscarTrayecto);
  $trayecto= mysqli_fetch_assoc($resultado);


   echo'  <br>
   <br>
   <br>
   <br>
   <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">El equipo "'.$trayecto["nombreTrayecto"].'" "'.$trayecto["idTrayecto"].'"
                    fue ingresado satifactoriamente
                    </h2>
                    <p class="text-muted">
                        Puede agregar Nuevos trayectos apretando el boton Registrar Nuevo trayecto, si desea salir Finalizar carga
                    </p>
                </div>
            </div>';
     echo '<form action="../Vista/RegistrarNuevoTrayecto.php" method="post">
  <div class="modal-footer">
               <a href="adminIndex.php" class="btn btn-primary">Finalizar carga</a>
                <button class="btn btn-primary  text-white " type="submit" name="ingresar">Registrar Nuevo trayecto</button>
            </div>
            </form>
     ';

    ?>