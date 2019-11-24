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
                <div class="col-md-12 text-center mb-3">
                    <h3 class="font-weight-bold">
                        A continuación se muestran todas las reservas realizadas por el cliente:
                    </h3>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-md-10 text-center mb-3">
                    <h4 class="text-muted">
                        <i class="fas fa-user"></i>
                        <?php echo $cliente; ?>
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
                                                    <th>Código de ítem</th>
                                                    <th>Pago</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                    $query = "select v.nombre as viaje, i.fkCodigoReserva as reserva, i.idItemReserva as item, i.pago as pago
                                                              from ItemReserva as i
                                                                   inner join reserva as r on i.fkcodigoReserva = r.codigo
	                                                               inner join viaje as v on r.codigoViaje = v.codigo
                                                                   inner join relacionClienteItemReserva as rel on i.idItemReserva = rel.fkIdItemReserva
                                                              where rel.fkEmailCliente like '".$cliente."';";
                                                    $resultado = mysqli_query($conexion, $query);
                                 while($row = mysqli_fetch_assoc($resultado)){
                                    echo "
                                         <tr>
                                        <td>".$row['viaje']."</td>
                                         <td>".$row['reserva']."</td>
                                        <td>".$row['item']."</td>";
                                        if($row['pago'] == true){
                                             echo "<td>Sí</td>";
                                             }else{
                                                echo "<td>No</td>";
                                            }
                                         echo   "<td>
                                         <form action='pdf.php?cliente=".$cliente."' method='post'>
                                        <input type='hidden' name='enviar' value=''>
                                        <div class='container'>
                                      <div class='row align-items-start'>";
                                         if($row['pago'] == true){
                                             echo "<button type='submit' name='' class='col btn btn-primary'>generar
                                                 </button> ";
                                                    }else{
                                                 echo "
                                         <button type='submit' name='' class='col btn btn-primary' disabled>
                                             </button>";
                                                                            }
                                 echo "</div>
                                     </div>
                                     </form>
                                      </td>
                                     </tr>";
                                                    }
                                                    ?>
                                                
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
