<!DOCTYPE html>
<html>
    <?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    include('../Modelo/adminValidarReporte.php');
    ?>

    <body>
        <div class='container buscador p-2 mb-2 mt-5 border border-info'>
            <div class="row justify-content-center">
                <div class="col-md-9 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de reportes</h2>
                </div>
            </div>
        </div>
            
        <div class='container buscador p-2 mb-2 mt-5 border border-info'>
            <div class="row justify-content-center">
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Tasa de ocupación por viaje y equipo</h4>
                    <p class="text-muted">REPORTE 1</p>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Facturación Mensual</h4>
                    <p class="text-muted">REPORTE 2</p>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Cabina más vendida</h4>
                    <p class="text-muted">REPORTE 3</p>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Facturación por Cliente</h4>
                    <p class="text-muted">REPORTE 4</p>
                </div>
                
            </div>
        </div>
            
    </body>
</html>
