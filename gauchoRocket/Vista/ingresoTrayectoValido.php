<?php

  include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');


    $idTrayecto = $_GET["codigoTrayecto"];
    $codigoVuelo= $_GET["vuelo"];


   echo'  <br>
   <br>
   <br>
   <br>
   <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">su viaje "'.$codigoVuelo.'" y
                    trayecto "'.$idTrayecto.'" fue ingresado satifactoriamente
                    </h2>
                    <p class="text-muted">
                        Puede seguir ingresando trayectos apretando el boton siguiente, si desea salir cancelar
                    </p>
                </div>
            </div>';
     echo '<form action="../Vista/ingresarTrayectos.php?viaje='.$codigoVuelo.'" method="post">
  <div class="modal-footer">
               <a href="adminIndex.php" class="btn btn-primary">Finalizar carga de Trayectos</a>
                <button class="btn btn-primary  text-white " type="submit" name="ingresar">Registrar Nuevo Trayecto</button>
            </div>
            </form>
     ';

    ?>