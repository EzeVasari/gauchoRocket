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
                    <h2 class="font-weight-bold">El equipo "'.$matricula.'" "'.$equipo["modelo"].'"
                    fue ingresado satifactoriamente

                    </h2>
                    <p class="text-muted">
                        Puede seguir ingresando trayectos apretando el boton siguiente, si desea salir cancelar
                    </p>
                </div>
            </div>';
     echo '<form action="../Vista/agregarNuevoEquipo.php" method="post">
  <div class="modal-footer">
               <a href="adminIndex.php" class="btn btn-primary">Finalizar carga de Equipos</a>
                <button class="btn btn-primary  text-white " type="submit" name="ingresar">Registrar Nuevo equipo</button>
            </div>
            </form>
     ';

    ?>