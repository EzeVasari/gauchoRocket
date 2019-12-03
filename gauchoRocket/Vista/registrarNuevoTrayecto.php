 <!DOCTYPE html>
<html>

 <?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
   
    ?>



  <br>
     
            <div class="row justify-content-center mt-4">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de Registro de Nuevos Trayectos</h2>
                    <p class="text-muted">
                        A través de esta sección puede ingresar un nuevo Trayecto.
                    </p>
                </div>
            </div>
        


<br>
<br>
<br>
<br>
         <div class='container buscador p-3 mb-3 border border-info'>
             <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="font-weight-bold">Trayecto</h2>
                </div>
            </div>
                    <form action="../Modelo/validarIngresoNuevoTrayecto.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-form-label">Nombre del trayecto:</label>
            <input type="text" class="form-control" name="nombreTrayecto" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">Id del trayecto:</label>
                <input type="text" class="form-control" name="IdTrayecto" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">Duracion del trayecto</label>
            <input type="text" class="form-control" name="duracion" required>
              </div>
              <div class="col-sm-5">
                <label class="col-form-label">Precio:</label>
            <input type="numeric" class="form-control" name="precio" required>
              </div>
            <div class="col-sm-5">
               <label class="col-form-label">Origen: </label>
               <select class='custom-select' name='origen'>
                            <option selected value='0'>Seleccione origen</option>
                            <?php
                                $consulta = "SELECT DISTINCT l.codigo as codigo, l.nombre as nombre
                                            FROM  lugar as l ";
                                $resultado = mysqli_query($conexion, $consulta);
                            
                                while($recorrer = mysqli_fetch_assoc($resultado)){
                                    echo "
                                            <option value='". $recorrer["codigo"] ."'>". $recorrer['nombre'] ."</option>
                                         ";
                                }
                            ?>
                  
                </select>
            
            </div>
              
              <div class="col-sm-7">
                    <label class="col-form-label">Destino</label>
                    <select class='custom-select' name='destino'>
                        <option selected value='0'>Seleccione destino</option>
                        <?php
                            
                        $consulta = "SELECT DISTINCT l.nombre as nombre, l.codigo as codigo
                                          FROM  lugar as l ";
                        $resultado = mysqli_query($conexion, $consulta);
                        while($recorrer = mysqli_fetch_assoc($resultado)){
                            echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                        }
                        ?>
                      
                    </select>
              </div>
            </div>
            <div class="form-group mt-2">
                <label class="col-form-label">Imagen:</label>
                <br>
                <input type="file" accept="image/png, image/jpeg, image/gif" name="img">   
            </div> 
            <div class="text-center">
            <a href='adminMantenimientoIndex.php' class='btn btn-secondary'>Cancelar</a>
           <button class='btn btn-primary  text-white ' type='submit' name='subir'>Registrar trayecto</button>
           </div>
        </form>
    </div>