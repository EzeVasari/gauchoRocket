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
                            <h5 class='card-title'>Generar reportes</h5>
                            <p class='card-text'>Puede generar reportes tales ver las cabinas más vendidas, vuelos más solicitados, entre otros</p>
                            <a href='adminReporteUno.php' class='btn btn-primary'>Reportes</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/reporte.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Mantenimiento</h5>
                            <p class='card-text'>Puede modificar los vuelos, cancelar o agregar un nuevo</p>
                            <a href='adminMantenimientoIndex.php' class='btn btn-primary'>acceder</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/factura.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Generar facturas</h5>
                            <p class='card-text'>Si un cliente solicita una factura, puede generarlas a través de este medio</p>
                            <a href='adminGenerarFacturaUno.php' class='btn btn-primary'>Facturas</a>
                         </div>
                    </div>
                </div>
                <div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                        <img src='img/admin/facturacion.jpg' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>Facturación</h5>
                            <p class='card-text'>Puede hacer clic aquí para poder ver el dinero generado en el día, semana, mes o año</p>
                            <a href='adminFacturacionUno.php' class='btn btn-primary'>Reporte</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
