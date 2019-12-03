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
                    <h4 class="font-weight-bold text-center">Tasa de ocupación</h4>
                    
                    <div class="text-center mt-4">
                        <a href="graficoTasaPorVuelo.php" class="btn btn-primary">Tasa por vuelo</a>
                        <a href="graficoTasaPorEquipo.php" class="btn btn-primary">Tasa por equipo</a>
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold text-center">Facturación Mensual</h4>
                    <div class="text-center mt-4">
                        <a href="graficoFacturacionMensual.php" class="btn btn-primary">Facturacion</a>
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold text-center">Cabina más vendida</h4>
                    <div class="text-center mt-4">
                        <a href="graficoCabinaMasVendida.php" class="btn btn-primary">Cabina más vendidas</a>
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-11 mb-5 ml-3 mr-3 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold text-center">Facturación por Cliente</h4>
                    <div class="text-center mt-4">
                        <a href="graficoFacturacionPorCliente.php" class="btn btn-primary">Facturacion</a>
                    </div>
                </div>
                
            </div>
        </div>
            
    </body>
</html>
