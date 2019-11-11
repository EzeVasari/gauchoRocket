<!DOCTYPE html>
<html>
    <?php
    session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
   
                $email = $_SESSION['user']; //Usuario logueado
                
                $query = "SELECT ir.fkCodigoReserva AS codigo, v.imagen AS img, v.nombre AS nombre,
                            v.descripcion AS descripcion, v.precio AS precio, idItemReserva as cod
                          FROM relacionClienteItemReserva AS rcr INNER JOIN itemReserva AS ir 
                            ON rcr.fkIdItemReserva = ir.idItemReserva
                          INNER JOIN Reserva AS r 
                            ON ir.fkCodigoReserva = r.codigo
                          INNER JOIN Viaje AS v 
                            ON r.codigoViaje = v.codigo
                          WHERE fkEmailCliente ='".$email."'";
                
                $resultado = mysqli_query($conexion, $query);
                
                if(mysqli_num_rows($resultado) > 0) {
                    echo '<body><br><br>
                            <div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 text-center mb-3">
                                        <h2 class="font-weight-bold">Sus reservas</h2>
                                        <p class="text-muted">Detallamos todos las reservas de las que dispone para poder abonar</p>
                                    </div>
                                </div>
                                <div class="row">';
                    
                    while ($centro = mysqli_fetch_assoc($resultado)){
                    echo "<div class='col mb-4'>
                            <div class='card reservas text-center mx-auto'>
                                <img src='".$centro['img']."' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$centro['nombre']." (#".$centro['codigo'].")</h5>
                                    <p class='card-text'>".$centro['descripcion']."</p>
                                    <a href='#' class='btn btn-primary' data-toggle='modal' data-target='#pagarReserva".$centro['cod']."'>Pagar</a>
                                </div>
                            </div>
                        </div>         
                        <div class='modal fade' id='pagarReserva".$centro['cod']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLabel'>Control de verificación médica</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='row'>";
                                                
                                            $queryDos = "SELECT fkEmailUsuario AS user, u.active AS estado, u.nombre AS nombre, u.apellido AS apellido, c.verifMedica AS medico, c.nivelVuelo AS nivel
                                                         FROM usuario AS u INNER JOIN cliente AS c
                                                            ON c.fkEmailUsuario = u.email
                                                         INNER JOIN relacionClienteItemReserva AS rcr
                                                            ON c.fkEmailUsuario = rcr.fkEmailCliente
                                                         INNER JOIN itemReserva AS ir
                                                            ON rcr.fkIdItemReserva = ir.idItemReserva
                                                        WHERE fkIdItemReserva = ".$centro['cod'];            
                                            $resultadoDos = mysqli_query($conexion, $queryDos);

                                            $habilitar = true;

                                            echo '<div class="container">
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
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>';
                                            while($usuario = mysqli_fetch_assoc($resultadoDos)){
                                                echo '<tr>
                                                        <td><i class="fas fa-user"></i> '.$usuario["nombre"].' '.$usuario["apellido"].'</td>
                                                        <td>'.$usuario["user"].'</td>';
                                                        if ($usuario["estado"] == true){
                                                            echo '<td><span class="badge badge-boxed badge-soft-primary">Activo</span></td>';
                                                        }else {
                                                            echo '<td><span class="badge badge-boxed badge-soft-warning">Inactivo</span></td>';
                                                        }

                                                        if ($usuario["medico"] == true){
                                                            echo '<td>Si</td>
                                                                  <td>'.$usuario["nivel"].'</td>';
                                                        }else {
                                                            echo '<td>No</td>
                                                                  <td>-</td>';
                                                            $habilitar = false;
                                                        }
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
                                    if($habilitar == false) {
                                                echo '<div class="alert alert-warning" role="alert">
                                                        No se puede pagar la reserva, existe usuarios sin verificación médica            </div>';
                                            }
                                echo' </div>'; 
                                                
                                        echo "        
                                                </div>";
                                                
                                                if($habilitar == false){
                                                    echo "<button type='button' class='btn btn-lg btn-primary' disabled='disabled'>Pagar</button>";
                                                }else{
                                                    echo "<a href='../Modelo/validacionPago.php?codigo=".$centro['codigo']."' class='btn btn-primary'>Pagar</a>";
                                                }
                                        
                                        echo "
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         ";
                        }
                }else {
                    echo "<br>
                                    <div class='container mt-5'>
                                        <div class='alert alert-warning' role='alert'>
                                            <h4 class='alert-heading'>¡Usted no tiene reservas!</h4>
                                            <p>Consulte nuestros <a href='destinos.php' class='alert-link'>destinos</a> y reserve un viaje a cualquier parte del sistema solar.</p>
                                        </div>
                                    </div>";
                }

                
                ?>
            </div>
        </div>
    </body>
</html>