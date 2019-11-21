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
                        <img src='img/admin/factura.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Generar facturas</h5>
                            <p class='card-text'>Si un cliente solicita una factura, puede generarlas a través de este medio</p>
                            <a href='#' class='btn btn-primary'>Facturas</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

