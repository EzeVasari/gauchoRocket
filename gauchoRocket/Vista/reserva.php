<?php
    include("head.php");
    include("navbar.php");
     session_start();
    if(!isset($_SESSION['user'])){
        header("Location:index.php?m=3");
        exit();
    }
    
    
    include("../Modelo/conexion.php");
    
    
    if(isset($_GET["codigo"])) {
    
    $codigo = $_GET["codigo"];
    $usuario = $_SESSION['user'];
    //Busqueda Viaje
    $reserva = "SELECT * FROM viaje WHERE codigo = " . $codigo ."";
    $resultado = mysqli_query($conexion, $reserva);
    $viaje = mysqli_fetch_assoc($resultado);
    }
    
    //Busqueda Usuario
    $busquedaUsuario = "SELECT * FROM usuario WHERE nick ='" .$_SESSION['user']. "'";
    $resultadoUsuario = mysqli_query($conexion, $busquedaUsuario);
    $datos = mysqli_fetch_assoc($resultadoUsuario);
    
    if(isset($_POST["pagar"])){
    //Registro reserva
    $fecha = "SELECT DATE_SUB(fecha, INTERVAL 2 HOUR) as fl FROM viaje WHERE codigo = ".$codigo; //Fecha límite
    $resultadoFecha = mysqli_query($conexion, $fecha);
    $fechaLimite = mysqli_fetch_assoc($resultadoFecha);

    $insert = "INSERT INTO relacionViajeCliente(codigoviaje, nombreusuario, checkin, pago, fechaLimite, fechaConfirmacion) VALUES
            (".$codigo.", '".$_SESSION['user']."', false, false, '".$fechaLimite['fl']."', null);
          ";
    $registro = mysqli_query($conexion, $insert);
    
    if($registro){
        header("Location:pago.php");
    
    } else {
        echo "<br><br><br> LCDLL";
    }
}
    
?>

<!DOCTYPE html>
<html>
    <body>
       
        <div class="container" style="margin-top: 5rem;">
           <h3 class="font-weight-bold" >Reserva</h3>
            <div class="row justify-content-between">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">¿Quienes viajan?</h4>
                    <p class="text-muted">El titular será responsable de hacer el check-in</p>
                    <h5>Persona 1</h5>
                    <form action="reserva.php" method="post">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Nombre</label>
                          <input type="text" class="form-control" value="<?php echo $datos["nombre"];?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Apellido</label>
                          <input type="text" class="form-control" value="<?php echo $datos["apellido"];?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label>DNI</label>
                        <input type="text" class="form-control" value="<?php echo $datos["dni"];?>" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="text" class="form-control" value="<?php echo $datos["fnac"];?>" readonly>
                      </div>
                      </div>
                   </div>
                   <div class="col-md-4 bg-light p-3 border border-primary rounded-lg">
                       <h4 class="font-weight-bold">Info de vuelo</h4>
                          <div class=''>
                            <h5 class='card-title'><?php echo $viaje['nombre'];?></h5>
                            <p class='card-text'><?php echo $viaje['descripcion'];?></p>
                            <h5 class='text-center'>Desde: U$ <?php echo $viaje['precio'];?></h5>
                          </div>
                   </div>
                </div>
            <div class="row mt-2">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Ubicación y Servicio</h4>
                    <p class="text-muted">Elija tipo de cabina y de servicio</p>
                   
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class='font-weight-bold'>Cabina</label>
                          <select class='custom-select' name='cabina'>
                            <option selected value="General">General</option>
                            <option value="Familiar">Familiar</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>
                        <div class="form-group col-md-6">
                          <label class='font-weight-bold'>Servicio</label>
                          <select class='custom-select' name='servicio'>
                            <option selected value="Standard">Standard</option>
                            <option value="Gourmet">Gourmet</option>
                            <option value="Spa">Spa</option>
                        </select>
                        </div>
                        </div>
                     </div>
                      <div class="col-md-7 mt-2 mb-3">
                       <button class='btn btn-primary w-100 text-white' type='submit' name='pagar'>Pagar reserva</button>
                       </div>
                    </form>
            </div>
                
            </div>
    </body>
</html>
