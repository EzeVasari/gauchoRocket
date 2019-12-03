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
                    <h2 class="font-weight-bold">Bienvenido al área de Registro de Vuelos</h2>
                    <p class="text-muted">
                        A través de esta sección puede ingresar un nuevo vuelo, una vez ingresado accedera a registrar los trayectos correspondientes a ese viaje
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
                    <h2 class="font-weight-bold">Vuelo</h2>
                </div>
            </div>
                    <form action="../Modelo/validarIngresoVuelo.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombreVuelo" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">Codigo:</label>
                <input type="text" class="form-control" name="codigoVuelo" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">Descripcion:</label>
            <input type="text" class="form-control" name="descripcion" required>
              </div>
              <div class="col-sm-5">
                <label class="col-form-label">Precio:</label>
            <input type="numeric" class="form-control" name="precio" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">Fecha y hora de salida:</label>
          <input type="text" class="form-control" name="fecha" placeholder="AAAA.MM.DD HH:MM:SS" required>
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


                
                <div class="col-sm-7">
                <label class="col-form-label">Nivel de vuelo</label>
               <select class='custom-select' name='nivel'>
                            <option value='0' selected>Elija nivel de vuelo...</option>";
                            <?php
                            $consulta = "select distinct tv.descripcion as nombre, tv.codigo as codigo
                                        from  tipoDeViaje as tv ;";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }
                            ?>
                        </select>

                </div>

                <div class="col-sm-5">
                <label class="col-form-label">Nave</label>
               <select class='custom-select' name='nave'>
                            <option value='0' selected>Elija tipo de nave...</option>";
                            <?php
                            $consulta = "select e.modelo as nombre,e.matricula as codigo
                            from  equipo as e 
                            order by e.modelo asc";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>".$recorrer["nombre"]." (".$recorrer['codigo'].")</option>";
                            }
                            ?>
                        </select>

                </div>

            </div>
            <div class="text-center mt-3">
            <a href='adminMantenimientoIndex.php' class='btn btn-secondary'>Cancelar</a>
           <button class='btn btn-primary  text-white ' type='submit' name='subir'>Registrar Viaje</button>
           </div>
        </form>
    </div>