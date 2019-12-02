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
        <div class='container buscador p-3 mt-5 mb-3 border border-info'>
            
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
            
            
            
            <div class='row'>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="cardList">
                                <div class="card-body"> 
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr class="align-self-center">
                                                    <th>Viaje</th>
                                                    <th>Trayecto</th>
                                                    <th>Código de reserva</th>
                                                    <th>Código de ítem</th>
                                                    <th>Pago</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                    $query = "select v.nombre as viaje, t.fkCodigoLugarOrigen as tOrigen, t.fkCodigoLugarDestino as tDestino,                           t.nombreTrayecto as tNombre, i.fkCodigoReserva as reserva, i.idItemReserva as item, i.pago as pago
                                                            from ItemReserva as i
                                                                inner join reserva as r on i.fkcodigoReserva = r.codigo
                                                                inner join relacionReservaTrayecto as rela on r.codigo = rela.fkCodigoReserva
                                                                inner join trayecto as t on rela.fkIdTrayecto = t.idTrayecto
                                                                inner join relacionViajeTrayecto as rvt on t.idTrayecto = rvt.fkIdTrayecto
                                                                inner join viaje as v on rvt.fkCodigoViaje = v.codigo
                                                                inner join lugar as l on l.codigo = t.fkCodigoLugarOrigen
                                                                inner join relacionClienteItemReserva as rel on i.idItemReserva = rel.fkIdItemReserva
                                                            where rel.fkEmailCliente like '".$cliente."';";
                                                    $resultado = mysqli_query($conexion, $query);
                                                
                                                
                                                
                                                
                                 if(mysqli_num_rows($resultado) > 0){
                                     while($row = mysqli_fetch_assoc($resultado)){
                                        echo "
                                             <tr>
                                            <td>".$row['viaje']."</td>
                                             <td>".$row['tNombre']."</td>
                                             <td>".$row['reserva']."</td>
                                            <td>".$row['item']."</td>";
                                            if($row['pago'] == true){
                                                 echo "<td>Sí</td>";
                                                 }else{
                                                    echo "<td>No</td>";
                                                }
                                             echo   "<td>
                                             <form action='pdf.php?reserva=".$row['item']."&cliente=".$cliente."' method='post'>
                                            <input type='hidden' name='enviar' value=''>
                                            <div class='container'>
                                          <div class='row align-items-start'>";
                                             if($row['pago'] == true){
                                                 echo "
                                                    <button type='submit' name='' class='col btn btn-primary'>generar
                                                    </button>
                                                      ";
                                            }else{
                                                 echo "
                                                    <button type='submit' name='' class='col btn btn-primary' disabled>generar
                                                    </button>
                                                      ";
                                                                                }
                                     echo "</div>
                                         </div>
                                         </form>
                                          </td>
                                         </tr>";
                                     }
                                 }else{
                                     echo "
                                            <div class='alert alert-warning' role='alert'>
                                                El cliente no tiene ninguna reserva abonada.
                                            </div>
                                          ";
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
