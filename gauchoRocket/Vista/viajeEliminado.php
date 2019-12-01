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

    <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">El viaje y sus trayectos ha sido eliminado correctamente</h2>
                    <p class="text-muted">
                        puede volver a elimminar un vuelo accediendo en volver eliminar o volver al inicio
                    </p>
                    <a href='adminMantenimiento.php' class='btn btn-primary'>volver a eliminar</a>
                            <a href='adminIndex.php' class='btn btn-primary'>Inicio</a>
                </div>
            </div>