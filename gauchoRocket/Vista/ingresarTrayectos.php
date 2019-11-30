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
 <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Una vez ingresado su viaje debe ingresar los trayectos
                    </h2>
                    <p class="text-muted">
                        Puede ingresar en la parte de destino y origen, los lugares precargados
                    </p>
                </div>
            </div>
<?php

$vuelo= $_GET["vuelo"];

echo'<form action="../Modelo/validarIngresoTrayecto.php?vuelo='.$vuelo.'" method="post">';
?>
          <div class="form-group">
            <label class="col-form-label">Nombre del Trayecto</label>
            <input type="text" class="form-control" name="nombreTrayecto" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">Id del Trayecto:</label>
                <input type="text" class="form-control" name="codigoTrayecto" required>
              </div>
              <div class="col-sm-5">
                <label class="col-form-label">Precio</label>
            <input type="text" class="form-control" name="precio" required>
              </div>
               <div class="col-sm-7">
                <label class="col-form-label">duracion</label>
            <input type="text" class="form-control" name="duracion" required>
              </div>
              <div class="col-sm-7">
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
              
              <div class="col-sm-5">
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
                      <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" name="subir" class="btn btn-danger">Subir</button>
            </div>
                </div>
            </form>







