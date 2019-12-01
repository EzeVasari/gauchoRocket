<?php

include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');


 if(isset($_GET["codigo"])){
      $codigoVuelo = $_GET["codigo"];
          
      $buscarPokemon = "SELECT * FROM viaje WHERE codigo =" . $codigoVuelo ;
      $resultado = mysqli_query($conexion, $buscarPokemon);
    
      $fila = mysqli_fetch_assoc($resultado);
     }
      
   
    
     
  

        
      ?>
 <div class="card m-auto" style="width: 19rem;">
  <img src="<?php echo $fila['imagen']?>" class="card-img-top m-auto" style="width: 11rem;">
  <div class="card-body">
    <form action="validaModificarViaje.php?numero=<?php echo $codigoVuelo?>" method="post">
          <div class="form-group">
            <label class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre'];?>">
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">Precio</label>
                <input type="text" class="form-control" name="precio" value="<?php echo $fila['precio'];?>" >
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">destino</label>
                <select class="browser-default custom-select" name="destino" value="<?php echo $fila['codigoLugarDestino'];?>">
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
                <label class="col-form-label">origen</label>
                <select class="browser-default custom-select" name="origen" value="<?php echo $fila['codigoLugarOrigen'];?>">
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
              </div>
            </div>
            <div class="mt-4 text-center">
                <a href="indexSesion.php" type="button" class="btn btn-secondary" >Cancelar</a>
                <button type="submit" name="modificar" class="btn btn-danger">Modificar</button>
            </div>
        </form>
  </div>
</div>