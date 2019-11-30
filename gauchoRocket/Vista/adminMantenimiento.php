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
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de generación de Modificacion/baja/alta de vuelos</h2>
                    <p class="text-muted">
                        A través de esta sección, podrá modificar, eliminar o habilitar un nuevo vuelo
                    </p>
                </div>
            </div>
            <form class='needs-validation' method='post' action='../Modelo/adminBusquedaMantenimiento.php'>
                <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class='fas fa-plane-departure'></i>  Origen</label>
                        <select class='custom-select' name='origen'>
                            <option selected value='0'>Seleccione origen</option>
                            <?php
$consulta="SELECT DISTINCT v.codigoLugarOrigen as codigo, l.nombre as nombre
              FROM viaje as v INNER JOIN lugar as l ON v.codigoLugarOrigen = l.codigo";
                            $resultado = mysqli_query($conexion, $consulta);
                            
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "
                                        <option value='". $recorrer["codigo"] ."'>". $recorrer['nombre'] ."</option>
                                     ";
                            }
                            ?>
                  
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip02'><i class='fas fa-plane-arrival'></i>  Destino</label>
                        <select class='custom-select' name='destino'>
                            <option selected value='0'>Seleccione destino</option>
                            <?php
                            
                            $consulta = "SELECT DISTINCT l.nombre as nombre, v.codigoLugarDestino as codigo
                                          FROM viaje as v inner join lugar as l on v.codigoLugarDestino = l.codigo";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }
                            ?>
                      
                        </select>
                    </div>
                </div>
                

              
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip05'><i class='far fa-calendar-alt'></i>  Fecha</label>
                        <div class='input-group date'>
                            <input type='text' autocomplete='off' id='fecha' class='form-control' name='fecha' placeholder='DD/MM/AAAA'>
                        </div>
                    </div>
              
                    <div class='col-md-3 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscar'><i class='fas fa-search'></i>  Buscar</button>
                    </div>
                </div>
            </form>
        </div>
<br>
<br>
<br>
<br>
         <div class='container buscador p-3 mb-3 border border-info'>
             <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">ingresar un nuevo vuelo</h2>
                </div>
            </div>
                    <form action="../Modelo/validarIngresoVuelo.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombreVuelo" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">codigo:</label>
                <input type="text" class="form-control" name="codigoVuelo" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">Descripcion</label>
            <input type="text" class="form-control" name="descripcion" required>
              </div>
              <div class="col-sm-5">
                <label class="col-form-label">Precio</label>
            <input type="text" class="form-control" name="precio" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">Fecha de salida y hora</label>
          <input type="text" class="form-control" name="fecha" placeholder="AAAA/MM/DD HH/MM/SS" required>
              </div>
            <div class="col-sm-5">
               <label class="col-form-label">Origen</label>
               <select class='custom-select' name='origen'>
                            <option selected value='0'>Seleccione origen</option>
                            <?php
$consulta="SELECT DISTINCT l.codigo as codigo, l.nombre as nombre
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
                            from  equipo as e ;";
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="subir" class="btn btn-danger">Subir</button>
            </div>
        </form>
    </div>
           

