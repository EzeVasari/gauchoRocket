<!DOCTYPE html>
<html>
    <?php
    session_start();
    


    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
    include('../Modelo/registroUsuarios.php');
    include('registroUsuarios.php');
    include('carrousel.php');
    ?>
    
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Sus reservas</h2>
                    <p class="text-muted">Detallamos todos las reservas de las que dispone para poder abonar</p>
                    <p class="text-muted">Recuerde que puede usar cualquier tarjeta de crédito para poder abonar</p>
                </div>
            </div>
            <div class="row">
                <?php
                $usuario = $_SESSION['user']; //Usuario logueado
                
                $query = "select rvc.codigo as codigo, v.img as imagen, v.nombre as nombre, v.descripcion as descripcion, v.precio as precio
                            from relacionViajeCliente as rvc inner join viaje as v on rvc.codigoviaje = v.codigo
                            where rvc.nombreusuario like '".$usuario."'";
                $resultado = mysqli_query($conexion, $query);

                while ($centro = mysqli_fetch_assoc($resultado)){
                    echo"
                        <div class='col mb-4'>
                            <div class='card text-center mx-auto'>
                                <img src='".$centro['imagen']."' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$centro['nombre']."</h5>
                                    <p class='card-text'>".$centro['descripcion']."</p>
                                    <h5 class='text-center'>Desde: U$ ".$centro['precio']."</h5>
                                    <a href='../Modelo/validacionPago.php?codigo=".$centro['codigo']."' class='btn btn-primary'>Pagar</a>
                                </div>
                            </div>
                        </div>
                        ";
                }
                ?>
            </div>
        </div>
    </body>
</html>
