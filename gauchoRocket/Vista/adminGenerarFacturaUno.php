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
        <br><br><br><br><br><br><br>
        <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de generación de facturas</h2>
                    <p class="text-muted">
                        A través de esta sección, podrá generar las facturas solicitas por clientes
                    </p>
                </div>
            </div>
            
            <form action="adminGenerarFacturaUno.php" method="post">
                <div class="row">
                    <div class="col-md-11">
                        <input type="text" class="form-control" name="buscarCliente" placeholder="Buscar cliente">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            <div  class='row'><div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="cardList">
                                <div class="card-body"> 
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr class="align-self-center">
                                                    <th>Cliente</th>
                                                    <th>Email</th>
                                                    <th>Estado</th>
                                                    <th>Verificación Médica</th>
                                                    <th>Nivel</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        <tbody>
                <?php
                include('../Modelo/adminBuscarClientes.php');
                ?>
            </div>
        </div>
    </body>
</html>
