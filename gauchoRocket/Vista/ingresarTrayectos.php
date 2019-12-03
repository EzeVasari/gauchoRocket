 <!DOCTYPE html>
<html>

 <?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
    ?>

    <script type="text/javascript" src="js/agregarTrayecto.js"></script>


   <?php
                     
        $vuelo= $_GET["viaje"];

        $viajes = 'select  *
                      from  viaje
                      where codigo = "'.$vuelo.'"';
        $resultadoViaje = mysqli_query($conexion, $viajes);
        $fila = mysqli_fetch_assoc($resultadoViaje);

        ?>

<br><br><div class='container buscador p-3 mb-3 mt-5 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="font-weight-bold">Ingresar Los Trayectos del viaje
                   "<?php echo $fila['nombre'];?>"
                    </h2>
                    <p class="text-muted">
                       descripcion de los trayectos del viaje
                        "<?php echo $fila['descripcion'];?>"
                    </p>
                    <p class="text-muted">
                        seleccione el trayecto que desea cargar para este vieje
                    </p>
                </div>
            </div>


<?php



echo'<form action="../Modelo/validarIngresoTrayecto.php?vuelo='.$vuelo.'" method="post">';
?>
          <div class="col-sm-7" id="contenedor1">
               <label class="col-form-label">Trayecto</label>
               <select class='custom-select' name='trayecto'>
                    <option selected value='0'>Seleccione trayecto</option>
                    <?php
                    $consulta="SELECT  idTrayecto as codigo, nombreTrayecto as nombre
                               FROM  trayecto ";
                    $resultado = mysqli_query($conexion, $consulta);

                    while($recorrer = mysqli_fetch_assoc($resultado)){
                        echo "
                                <option value='". $recorrer["codigo"] ."'>". $recorrer['nombre'] ."</option>
                             ";
                    }
                    ?>
                </select>
            </div>
        </div>
           
            
            
            <div class="modal-footer">
                <a href='adminIndex.php' class='btn btn-primary'>Cancelar</a>
                <button class='btn btn-primary text-white' type='submit' name='subir'>Registrar trayecto</button>
            </div>
        
            </form>







