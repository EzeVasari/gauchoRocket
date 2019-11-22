<!DOCTYPE html>
<html>
<?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    $cliente = $_POST['cliente'];
?>
    <body>
        <br><br><br><br><br><br><br>
        <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-10 text-center mb-3">
                    <h3 class="font-weight-bold">
                        A continuación se muestran todas las reservas abonadas por el cliente seleccionado
                    </h3>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-10 text-center mb-3">
                    <h4 class="text-muted">
                        <i class="fas fa-user"></i>
                        Cliente: <?php echo $cliente; ?>
                    </h4>
                </div>
            </div>
            
            
            
            <div  class='row'><div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="cardList">
                                <div class="card-body"> 
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr class="align-self-center">
                                                    <th>Viaje</th>
                                                    <th>Código de reserva</th>
                                                    <th>Pago</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                    
                                                    
                                                    <td>VIAJE</td>
                                                    <td>CODIGO</td>
                                                    <td>SÍ</td>
                                                    <td>
                                                        <form action='#' method='post'>
                                                            <input type='hidden' name='cliente".$usuario["dni"]."' value='".$usuario["user"]."'>
                                                            <div class='container'>
                                                                <div class='row align-items-start'>
                                                                    <button type='submit' name='clienteEncontrado".$usuario["dni"]."' class='col btn btn-primary'>
                                                                        Generar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    
                                                    
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <!--end table-responsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
