<!-- Cards -->
  <div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-md-7 text-center mb-3">
             <h2 class="font-weight-bold">Nuestros destinos</h2>
             <p class="text-muted">Recorré todo el sistema solar</p>
         </div>
     </div>
      <div class="row">
         <?php 
          while($viaje = mysqli_fetch_assoc($resultado)){
              
            echo "<div class='col mb-4'>
                    <div class='card text-center mx-auto'>
                      <img src='". $viaje["img"] . "' class='card-img-top' alt='...'>
                          <div class='card-body'>
                            <h5 class='card-title'> ". $viaje['nombre'] ."</h5>
                            <p class='card-text'> ". $viaje['descripcion'] . "</p>
                            <h5 class='text-center'>Desde: U$ ". $viaje['precio'] ."</h5>
                            <a href='reserva.php?codigo=" . $viaje['codigo'] . "' class='btn btn-primary'>Reservar</a>
                          </div>
                    </div>
                </div>
                ";
          }
        ?>
      </div>
  </div>
