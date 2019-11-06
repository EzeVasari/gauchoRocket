<nav class="navbar fixed-top shadow-sm navbar-expand-lg navbar-light bg-light mb-1">
      <h2><a class="navbar-brand text-black mx-4 mx-xs-1" href="index.php">
        <img src="img/cohete.png" width="25" height="25" alt="">
        Gaucho Rocket
      </a></h2>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                 <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="destinos.php">Destinos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contacto.php" tabindex="-1">Contacto</a>
                  </li>
                </ul>
            </div>
           <div class="col-md-4">
               <?php
               if(isset($_COOKIE['login'])){
                   echo "
                        <ul class='navbar-nav'>
                            <li class='nav-item'>
                                <a class='nav-link' href='../Modelo/validacionTurnoMedico.php'>Médico</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='pago.php'>Reservas</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link text-right text-primary' href='cerrarSesion.php'>Cerrar sesión</a>
                            </li>
                        </ul>
                        ";
               }else{
                   echo '<a class="nav-link text-right text-primary" href="#" data-toggle="modal" data-target="#iniciar">Iniciar sesión</a>';
                    }
               ?>
            </div>
        </div>
   </div>
  </div>
   
</nav>
  