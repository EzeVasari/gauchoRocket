<!DOCTYPE html>
<html>
    <?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    ?>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/reporte.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Baja o Modificacion</h>
                            <p class='card-text'>Puede modificar o eliminar los vuelos</p>
                            <a href='adminMantenimiento.php' class='btn btn-primary'>acceder</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/reporte.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>ingreso de vuelos</h5>
                            <p class='card-text'>Puede agregar nuevos vuelos y los trayectos de este mismo</p>
                            <a href='ingresarVuelo.php' class='btn btn-primary'>acceder</a>
                         </div>
                    </div>
                </div>
               </div>
        </div>
    </body>
</html>