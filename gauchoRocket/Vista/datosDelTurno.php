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
                    <h2 class="font-weight-bold">Su turno ha sido registrado exitosamente</h2>
                    <p class="text-muted">Recuerde que puede presentarse cualquier día antes del plazo límite de su confirmación de reserva, además de que si no obtiene el codigo necesario su reserva sera dada de baja en sistema</p>
                </div>
            </div>
            <div class="row">
                <?php
                $usuario = $_SESSION['user']; //Usuario logueado
                
                $query = "select * from turnomedico where fkEmailCliente like '".$usuario."'";
                $resultado = mysqli_query($conexion, $query);
                
                $centroMedico = mysqli_fetch_assoc($resultado);
            
                    echo"
                        <div class='col mb-4'>
                              <h5 class='card-title'>Ubicacion: ".$centroMedico['nombreLugar']."</h5>
                              <p class='card-text'>Codigo de turno: ".$centroMedico['codigo']."</p>
                              <p class='card-text'>Fecha de realización: ".$centroMedico['fechaTurnoMedico']."</p>
                                </div>
                            </div>
                        </div>
                        ";
                
                ?>
            </div>
        </div>
    </body>
</html>