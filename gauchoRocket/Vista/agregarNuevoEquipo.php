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
    

    
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de Registro de Equipos</h2>
                    <p class="text-muted">
                        A través de esta sección puede ingresar un nuevo equipo
                    </p>
                </div>
            </div>
        


<br>
<br>
<br>
<br>
         <div class='container buscador p-3 mb-3 border border-info'>
             <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">ingresar un nuevo equipo</h2>
                </div>
            </div>
                    <form action="../Modelo/validarRegistroEquipo.php" method="post">
          <div class="form-group">
            <label class="col-form-label">modelo:</label>
            <input type="text" class="form-control" name="modelo" required>
          </div>
          <div class="row">
              <div class="col-sm-5">
                <label class="col-form-label">matricula</label>
                <input type="text" class="form-control" name="matricula" required>
              </div>
              <div class="col-sm-7">
                <label class="col-form-label">capacidad Suit</label>
            <input type="text" class="form-control" name="Suit" required>
              </div>
              <div class="col-sm-5">
                <label class="col-form-label">capacidad General</label>
            <input type="text" class="form-control" name="general" required>
              </div>
              <div class="col-sm-7">
               <label class="col-form-label">capacidad Familiar</label>
            <input type="text" class="form-control" name="familiar" required>
              </div>
                <div class="col-sm-7">
                <label class="col-form-label">tipo de equipo</label>
               <select class='custom-select' name='nivel'>
                            <option value='0' selected>Elija el tipo de equipo...</option>";
                            <?php
                            $consulta = "select distinct tv.descripcion as nombre, tv.codigo as codigo
                                        from  tipoDeEquipo as tv ;";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }
                            ?>
                        </select>

                </div>

               

                
            
                      
            </div>
            <a href='adminMantenimientoIndex.php' class='btn btn-primary'>Cancelar</a>
           <button class='btn btn-primary  text-white ' type='submit' name='subir'>Registrar Equipo</button>
        </form>
    </div>