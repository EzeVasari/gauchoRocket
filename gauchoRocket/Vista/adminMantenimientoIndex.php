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
                        <img src='img/admin/viajes.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Ingreso de vuelos</h5>
                            <p class='card-text text-muted'>Agregar nuevos vuelos y sus trayectos</p>
                            <a href='ingresarVuelo.php' class='btn btn-primary'>Nuevos vuelos</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/altasBajas.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Baja o modificacion de vuelos</h5>
                            <p class='card-text text-muted'>Puede modificar o eliminar los vuelos</p>
                            <a href='adminMantenimiento.php' class='btn btn-primary'>Modificar vuelos</a>
                         </div>
                    </div>
                </div>

                 <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/equiposUno.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Ingreso de Equipos</h5>
                            <p class='card-text'>Puede agregar nuevos equipos </p>
                            <a href='agregarNuevoEquipo.php' class='btn btn-primary'>Ingresar equipos</a>
                         </div>
                    </div>
                </div>
                  <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/equiposDos.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Eliminacion de equipos</h5>
                            <p class='card-text'>Puede eliminar Equipos</p>
                            <a href='eliminarEquipo.php' class='btn btn-primary'>Eliminar equipos</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/equiposDos.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Ingreso de trayectos</h5>
                            <p class='card-text'>Puede agregar un nuevo trayecto</p>
                            <a href='registrarNuevoTrayecto.php' class='btn btn-primary'>Ingresar trayectos</a>
                         </div>
                    </div>
                </div>
               </div>
        </div>
    </body>
</html>