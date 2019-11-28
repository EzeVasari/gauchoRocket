<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');

    echo'<body><br><br>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-7 text-center mb-3">
                        <h2 class="font-weight-bold">Check-in</h2>
                        <p class="text-muted">Seleccione los asientos que desea ocupar</p>
                        <h4 class="font-weight-bold">General</h4>
                    </div>
                </div>
      <div class="row justify-content-center">
        <div class="seat">  
          <input type="checkbox" value="None" id="seat1" name="check" />
          <label for="seat1"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat2" name="check"/>
          <label for="seat2"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat3" name="check" />
          <label for="seat3"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat4" name="check" />
          <label for="seat4"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat5" name="check" />
          <label for="seat5"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat6" name="check" />
          <label for="seat6"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat7" name="check" />
          <label for="seat7"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat8" name="check" />
          <label for="seat8"></label>
        </div><div class="seat">  
          <input type="checkbox" value="None" id="seat9" name="check" />
          <label for="seat9"></label>
        </div>
        <div class="seat">  
          <input type="checkbox" value="None" id="seat10" name="check" disabled/>
          <label for="seat10"></label>
        </div>
      </div>
<link rel="stylesheet" href="css/estilosCheckin.css">
        </body>';
?>