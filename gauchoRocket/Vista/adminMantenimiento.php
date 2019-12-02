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
            <form class='needs-validation' method='post' action='adminBusquedaMantenimiento.php'>
                <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class='fas fa-plane-departure'></i>  Origen</label>
                        <select class='custom-select' name='origen'>
                            <option selected value='0'>Seleccione origen</option>
                            <?php
$consulta="SELECT DISTINCT l.codigo as codigo, l.nombre as nombre
              FROM lugar as l ";
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
                            
                            $consulta = "SELECT  l.nombre as nombre, l.codigo as codigo
                                          FROM  lugar as l ";
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
       
                
            
                       
             
         
           

