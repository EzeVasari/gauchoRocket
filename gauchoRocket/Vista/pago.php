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
                
                $query = "SELECT ir.fkCodigoReserva AS codigo, v.imagen AS img, v.nombre AS nombre,
                            v.descripcion AS descripcion, v.precio AS precio, idItemReserva as cod
                        FROM relacionClienteItemReserva AS rcr
                            INNER JOIN itemReserva AS ir ON rcr.fkIdItemReserva = ir.idItemReserva
                            INNER JOIN Reserva AS r ON ir.fkCodigoReserva = r.codigo
                            INNER JOIN Viaje AS v ON r.codigoViaje = v.codigo
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
                        echo"       <div class='col mb-4'>
                                        <div class='card reservas text-center mx-auto'>
                                            <img src='".$centro['img']."' class='card-img-top' alt='...'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>".$centro['nombre']." (#".$centro['codigo'].")</h5>
                                                <p class='card-text'>".$centro['descripcion']."</p>
                                                <a href='#' class='btn btn-primary' data-toggle='modal' data-target='#pagarReserva".$centro['cod']."'>
                                                    <i class='fas fa-dollar-sign'></i> Pagar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                
                                <div class='modal fade' id='pagarReserva".$centro['cod']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-lg' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>Sus reservas y acompañantes</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='row'>";
                                                
                                                $queryDos = "select fkEmailUsuario as user, verifMedica as medico
                                                            from relacionClienteItemReserva as rel
                                                                inner join cliente as c on rel.fkEmailCliente = c.fkEmailUsuario
                                                            where fkIdItemReserva = ".$centro['cod']."";
                                                $resultadoDos = mysqli_query($conexion, $queryDos);
                        
                                                $habilitar = "SI";
                                                while($centroDos = mysqli_fetch_assoc($resultadoDos)){
                                                    if($centroDos['medico'] == 0){
                                                        $valor = "No.";
                                                        $habilitar = "NO";
                                                    }else{
                                                        $valor = "Sí.";
                                                    }
                                                    
                                                    echo "
                                                        <div class='col mb-4'>
                                                            <div class='card reservas text-center mx-auto'>
                                                                <img src='img/usuario.jpg' class='card-img-top' alt='...'>
                                                                <div class='card-body'>
                                                                    <h5 class='card-title'>Usuario: ".$centroDos['user']."</h5>
                                                                    <p class='card-text'>Verificación médica: ".$valor."</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         ";
                                                    
                                                }
                                                
                                        echo "        
                                                </div>";
                                                
                                                if($habilitar == "NO"){
                                                    echo "<button type='button' class='btn btn-lg btn-primary' disabled='disabled'>PAGAR</button>";
                                                }else{
                                                    echo "<button type='button' class='btn btn-primary btn-lg'>PAGAR</button>";
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