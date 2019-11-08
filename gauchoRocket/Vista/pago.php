<!DOCTYPE html>
<html>
    <?php
    session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
   
                $email = $_SESSION['user']; //Usuario logueado
                
                $query = "SELECT ir.fkCodigoReserva AS codigo, v.imagen AS img, v.nombre AS nombre, v.descripcion AS descripcion, v.precio AS precio
                FROM relacionClienteItemReserva AS rcr INNER JOIN itemReserva AS ir
                    ON rcr.fkIdItemReserva = ir.idItemReserva
                INNER JOIN Reserva AS r
                    ON ir.fkCodigoReserva = r.codigo
                INNER JOIN Viaje AS v
                    ON r.codigoViaje = v.codigo
                WHERE fkEmailCliente ='".$email."'";
                
                $resultado = mysqli_query($conexion, $query);
                
                if(mysqli_num_rows($resultado) > 0) {
                    echo '<body>
                            <br><br><div class="container mt-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 text-center mb-3">
                                        <h2 class="font-weight-bold">Sus reservas</h2>
                                        <p class="text-muted">Detallamos todos las reservas de las que dispone para poder abonar</p>
                                    </div>
                                </div>
                                <div class="row">';
                    
                    while ($centro = mysqli_fetch_assoc($resultado)){
                        echo"<div class='col mb-4'>
                                <div class='card reservas text-center mx-auto'>
                                    <img src='".$centro['img']."' class='card-img-top' alt='...'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>".$centro['nombre']." (#".$centro['codigo'].")</h5>
                                        <p class='card-text'>".$centro['descripcion']."</p>
                                        <a href='../Modelo/validacionPago.php?codigo=".$centro['codigo']."' class='btn btn-primary'><i class='fas fa-dollar-sign'></i> Pagar</a>
                                    </div>
                                </div>
                            </div>
                            ";
                    }  
                }else {
                    echo "<br><div class='container mt-5'>
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