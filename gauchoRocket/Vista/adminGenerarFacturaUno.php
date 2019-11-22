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
            
            <form>
                <div class="row">
                    <div class="col-md-11">
                        <input type="text" class="form-control" name="buscarCliente" placeholder="Buscar cliente">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
            <div  class='row'>
                
                <?php
                echo '
                <div class="container">
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
                                        <tbody>';
                
                $query = "select u.active as estado, u.nombre as nombre, u.apellido as apellido,
                                u.email as user, c.verifMedica as medico, c.nivelVuelo as nivel, u.dni as dni
                             from cliente as c
	                           inner join usuario as u on c.fkEmailUsuario = u.email";            
                $resultado = mysqli_query($conexion, $query);
                
                while($usuario = mysqli_fetch_assoc($resultado)){
                    echo '
                        <tr>
                            <td><i class="fas fa-user"></i> '.$usuario["nombre"].' '.$usuario["apellido"].'</td>
                                <td>'.$usuario["user"].'</td>';
                                if ($usuario["estado"] == true){
                                    echo '<td><span class="badge badge-boxed badge-soft-primary">Activo</span></td>';
                                }else{
                                    echo '<td><span class="badge badge-boxed badge-soft-warning">Inactivo</span></td>';
                                }
                                
                                if ($usuario["medico"] == true){
                                    echo '
                                        <td>Si</td>
                                        <td>'.$usuario["nivel"].'</td>';
                                }else{
                                    echo '
                                        <td>No</td>
                                        <td>-</td>';
                                }
                            echo "
                                <td>
                                    <form action='#' method='post'>
                                        <input type='hidden' name='cliente".$usuario["dni"]."' value='".$usuario["user"]."'>
                                        <div class='container'>
                                            <div class='row align-items-start'>";
                                            if($usuario["estado"] == true){
                                                echo "<button type='submit' name='clienteEncontrado".$usuario["dni"]."' class='col btn btn-primary'>
                                                        Seleccionar
                                                      </button>";
                                            }else{
                                                echo "<button type='submit' name='clienteEncontrado".$usuario["dni"]."' class='col btn btn-primary' disabled>
                                                        Seleccionar
                                                      </button>";
                                            }
                                      echo "</div>
                                        </div>
                                    </form>
                                </td>";
                }
                
                echo '
                    </tr>
                    </tbody>
                    </table>
                    </div>
                        <!--end table-responsive-->
                    </div>
                    </div>
                    </div>
                    </div>';
            
                ?>
            
            </div>
        </div>
    </body>
</html>
