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
                        Puede ingresar en la parte de destino y origen, las opciones precargadas
                    </p>
                </div>
            </div>


<form action="../Modelo/validarIngresoTrayecto.php?vuelo=<?php echo $codigo ?>" method="post">
          <div class="form-group">
            <label class="col-form-label">Nombre del Trayecto</label>
            <input type="text" class="form-control" name="nombreTrayecto" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">Precio</label>
            <input type="text" class="form-control" name="precio" required>
              </div>
               <div class="col-sm-7">
                <label class="col-form-label">duracion</label>
            <input type="text" class="form-control" name="duracion" required>
              </div>
<<<<<<< HEAD
              <div class='col-sm-7' id='contenedor1'>
               <label class='col-form-label'>trayecto</label>
               <select class='custom-select' name='trayecto'>
                            <option selected value='0'>Seleccione trayecto</option>
                            <?php
$consulta='SELECT  idTrayecto as codigo, nombreTrayecto as nombre
              FROM  trayecto ';
                            $resultado = mysqli_query($conexion, $consulta);
                            
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo '
                                        <option value="'. $recorrer['codigo'] .'">'. $recorrer['nombre'] .'</option>
                                     ';
                            }
                            ?>
                  
                        </select>
            
              </div>
            </div>
              <div class="btn btn-primary" id="btn-nuevoTrayecto">Agregar Trayecto</div>
=======
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
>>>>>>> e52984b51e04d4fa0f19c0688271bb111ce629a6

                </select>
            </div>
        </div>
            <input type="button" class="btn btn-primary mt-2" id="btn-nuevoTrayecto" value="Agregar trayecto">
            
            
            <div class="modal-footer">
                <a href='adminIndex.php' class='btn btn-primary'>Cancelar</a>
                <button class='btn btn-primary text-white' type='submit' name='subir'>Registrar trayecto</button>
            </div>
        
            </form>







