<!DOCTYPE html>
<html>

 <?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    ?>


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

  <div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-md-7 text-center mb-3">
             <h2 class="font-weight-bold">Nuestros Equipos</h2>
         </div>
     </div>
      <div class="row">
         <?php 


         $buscarEquipo = "SELECT * FROM equipo";
    $resultado = mysqli_query($conexion, $buscarEquipo);
          while($equipo = mysqli_fetch_assoc($resultado)){
              
            echo "<div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                          <div class='card-body'>
                            <h5 class='card-title'> ". $equipo['matricula'] ."</h5>
                            <p class='card-text'> ". $equipo['modelo'] . "</p>
                            <h5 class='text-center'>capacidad suit: ". $equipo['capacidadSuit'] ."</h5>
                            <h5 class='text-center'>capacidad familiar: ". $equipo['capacidadFamiliar'] ."</h5>
                            <h5 class='text-center'>capacidad general: ". $equipo['capacidadGeneral'] ."</h5>
                            <a href='../Modelo/validarEliminarEquipo.php?matricula=" . $equipo['matricula'] . "' class='btn btn-primary'>eliminar</a>
                          </div>
                    </div>
                </div>
                ";
          }
        ?>
      </div>
  </div>