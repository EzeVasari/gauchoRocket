<!DOCTYPE html>
<html>
    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    
    ?>
    
    <body>
        <br><br><div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h3 class="font-weight-bold">Su turno ha sido registrado exitosamente</h2>
                    <p class="text-muted"><small>Recuerde que puede presentarse cualquier día antes del plazo límite de su confirmación de reserva, además de que si no obtiene el codigo necesario su reserva sera dada de baja en sistema </small></p>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php
                $usuario = $_SESSION['user']; //Usuario logueado
                
                $query = "SELECT * , time(fechaTurnoMedico) as hora, date(fechaTurnoMedico) as fecha FROM turnomedico WHERE fkEmailCliente LIKE '".$usuario."'";
                $resultado = mysqli_query($conexion, $query);
                
                $centroMedico = mysqli_fetch_assoc($resultado);
            
                    echo '<div class="col-lg-4 col-md-12">
                            <div class="card text-center border border-primary">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title"> Turno N° '.$centroMedico["codigo"].'</h4>
                                        <hr class="border border-primary">
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text"><span class="font-weight-bold">Ubicación: </span> '.$centroMedico["nombreLugar"].'</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text"><span class="font-weight-bold">Fecha: </span> '.$centroMedico["fecha"].'</p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text"><span class="font-weight-bold">Hora: </span> '.$centroMedico["hora"].'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                
                ?>
            </div>
        </div>
    </body>
</html>