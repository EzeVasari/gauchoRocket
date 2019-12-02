<?php
include("../Modelo/validarPaginasParaClientes.php");
include("../Modelo/validacionReserva.php");
include('../Modelo/conexion.php');

 if(!isset($_POST["confirmarReserva"])) {
    echo  '<!DOCTYPE html>
<html>
   <script type="text/javascript" src="js/agregarPersona.js"></script>
    <body>
        <div class="container" style="margin-top: 5rem;">
           <h3 class="font-weight-bold" >Reserva</h3>
            <div class="row justify-content-between" id="tabla">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg" >
                    <h4 class="font-weight-bold">¿Quienes viajan?</h4>
                    <p class="text-muted">Se pueden reservar pasajes de hasta 5 personas.</p>
                    <form id="contenedor" action="reserva.php?codigo='.$codigo.'" method="post">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Nombre</label>
                          <input type="text" class="form-control" value="'.$datos["nombre"].'" name="nombres[]" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Apellido</label>
                          <input type="text" class="form-control" value="'.$datos["apellido"].'" name="apellidos[]" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label>DNI</label>
                        <input type="text" class="form-control" value="'.$datos["dni"].'" name="documentos[]" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label>E-mail</label>
                        <input type="text" class="form-control" value="'.$datos["email"].'" name="emails[]"readonly>
                      </div>
                      </div>   
                   </div>
                </div>
                <div class="btn btn-primary mt-2" id="btn-nuevaPersona"><i class="fas fa-plus"></i> Agregar persona</div>
            <div class="row mt-2">
                <div class="col-md-7 mb-2 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Trayecto</h4>
                    <p class="text-muted">Elija trayecto que va a realizar</p>
                   
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Origen</label>
                          <select class="custom-select" name="origenTrayecto">';
      
                        $consulta = "SELECT DISTINCT l.nombre as nombreLugar, l.codigo as codigo
                                              FROM lugar as l INNER JOIN trayecto as t 
                                                ON l.codigo = t.fkCodigoLugarOrigen
                                              INNER JOIN relacionViajeTrayecto as rvt 
                                                ON t.idTrayecto = rvt.fkIdTrayecto
                                              WHERE rvt.fkCodigoViaje = ".$_GET['codigo']."";
                                
                        $resultado = mysqli_query($conexion, $consulta);

                        while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "
                                        <option value='". $recorrer["codigo"] ."'>". $recorrer['nombreLugar'] ."</option>
                                     ";
                        }

     echo '</select>
                    </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Destino</label>
                          <select class="custom-select" name="destinoTrayecto">';
     
                          $consulta = "SELECT DISTINCT l.nombre as nombreLugar, l.codigo as codigo
                                              FROM lugar as l INNER JOIN trayecto as t 
                                                ON l.codigo = t.fkCodigoLugarDestino
                                              INNER JOIN relacionViajeTrayecto as rvt 
                                                ON t.idTrayecto = rvt.fkIdTrayecto
                                              WHERE rvt.fkCodigoViaje = ".$_GET['codigo']."";
                                
                                $resultado = mysqli_query($conexion, $consulta);
                                    
                                    while($recorrer = mysqli_fetch_assoc($resultado)){
                                        echo "
                                                <option value='". $recorrer['codigo'] ."'>". $recorrer['nombreLugar'] ."</option>
                                             ";
                            }
     
     echo '             
                        </select>
                        </div>
                        </div>
                     </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Ubicación y Servicio</h4>
                    <p class="text-muted">Elija tipo de cabina y de servicio</p>
                   
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Cabina</label>
                          <select class="custom-select" name="cabina">
                            <option selected value="1">General</option>
                            <option value="2">Familiar</option>
                            <option value="3">Suite</option>
                        </select>
                    </div>
                        <div class="form-group col-md-6">
                          <label class="font-weight-bold">Servicio</label>
                          <select class="custom-select" name="servicio">
                            <option selected value="1">Standard</option>
                            <option value="2">Gourmet</option>
                            <option value="3">Spa</option>
                        </select>
                        </div>
                        </div>
                     </div>
                      <div class="col-md-7 mt-2 mb-3">
                       <button class="btn btn-primary w-100 text-white mt-3" type="submit" name="confirmarReserva">Confirmar reserva</button>
                       </div>
                    </form>
            </div>
                
            </div>
    </body>
</html>';
 }












?>

           
