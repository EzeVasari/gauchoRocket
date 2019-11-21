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
                        <img src='img/admin/facturacion.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Facturación</h5>
                            <p class='card-text'>Puede hacer clic aquí para poder ver el dinero generado en el día, semana, mes o año</p>
                            <a href='#' class='btn btn-primary'>Reporte</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

