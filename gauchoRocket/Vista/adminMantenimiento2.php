<div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-md-7 text-center mb-3">
             <h2 class="font-weight-bold">Viajes</h2>
             <p class="text-muted"></p>
         </div>
     </div>
      <div class="row">
         <?php 
          while($viaje = mysqli_fetch_assoc($resultado)){
              
            echo "<div class='col mb-4'>
                    <div class='card destinos text-center mx-auto'>
                          <div class='card-body'>
                            <h5 class='card-title'> ". $viaje['nombre'] ."</h5>
                            <p class='card-text'> ". $viaje['descripcion'] . "</p>
                            <h5 class='text-center'>Desde: U$ ". $viaje['precio'] ."</h5>
                            <a href='modificarViaje.php?codigo=" . $viaje['codigo'] . "' class='btn btn-primary'>modificar</a>
                            <a href='../Modelo/eliminarViaje.php?codigo=" . $viaje['codigo'] . "' class='btn btn-primary'>eliminar</a>
                          </div>
                    </div>
                </div>
                ";
          }
        ?>
      </div>
  </div>