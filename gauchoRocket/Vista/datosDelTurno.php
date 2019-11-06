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
                    <h2 class="font-weight-bold">Su Turno ha sido registrado exitosamente </h2>
                    <p class="text-muted">Recuerde que puede presentarse cualquier dia antes del plazo limite de su conformacion de reserva, ademas de que si no obtiene el codigo necesario su reserva sera dada de baja en sistema</p>
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
                              <h5 class='card-title'>Ubicacion ".$centroMedico['nombreLugar']."</h5>
                              <p class='card-text'>Codigo de turno ".$centroMedico['codigo']."</p>
                                </div>
                            </div>
                        </div>
                        ";
                
                ?>
            </div>
        </div>
    </body>
</html>