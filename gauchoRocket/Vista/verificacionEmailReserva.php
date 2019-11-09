<?php
    include("../Modelo/conexion.php");
    include("head.php");
    include("navbar.php");
    include("../Modelo/iniciarSesion.php");
    include("iniciarSesion.php");
    

    if((isset($_GET['email'])) && (isset($_GET['hash']))){
        $email = $_GET['email']; 
        $hash = $_GET['hash'];
        
        if(isset($_POST["confirmarPass"])){
            $buscarUsuario = "SELECT email, codigoHash, active FROM usuario WHERE email='".$email."' AND codigoHash='".$hash."' AND active= false";
            $resultado = mysqli_query($conexion, $buscarUsuario);
            
            if($usuario = mysqli_fetch_assoc($resultado)){
                $actualizarUsuario = "UPDATE usuario SET active = true WHERE email = '".$email."'";
                $resultadoDos = mysqli_query($conexion, $actualizarUsuario);
                
                $pass = md5($_POST["pass"]);
            
                $guardarPass = "INSERT INTO login (fkEmailUsuario, pass) VALUES ('".$email."', '".$pass."')";
                $resultadoGuardarPass = mysqli_query($conexion, $guardarPass);

                echo "<br><br><div class='container mt-5'>
                        <div class='alert alert-success' role='alert'>
                          <h4 class='alert-heading'>¡Cuenta confirmada!</h4>
                          <p>Bien, has confimado tu cuenta mediante el email <span class='font-weight-bold'>$email</span>. Ya puedes <a href='#' class='alert-link' data-toggle='modal' data-target='#iniciar'>iniciar sesión</a> y utilizar todos nuestros servicios, muchas gracias.</p>
                        </div>
                        </div>";
            }else{
                echo "<br><br><div class='container mt-5'>
                            <div class='alert alert-danger' role='alert'>
                              <h4 class='alert-heading'>¡Ya confirmaste tu email!</h4>
                              <p>Ya has confimado tu cuenta de email $email y confeccionaste una contraseña. <a href='#' class='alert-link' data-toggle='modal' data-target='#iniciar'>Inicia sesión</a></p>
                            </div>
                            </div>";
            }
        }else {
            echo '<br><div class="container mt-5">
            <div class="card">
               <div class="card-header">
                  Confirme su contraseña:              
                </div>
              <div class="card-body">
                <form class="form-inline" action="verificacionEmailReserva.php?email='.$email.'&hash='.$hash.'" method="post">
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="sr-only">Email</label>
                    <input type="email" readonly class="form-control-plaintext" value="'.$email.'">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label class="sr-only">Contraseña</label>
                    <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
                  </div>
                  <button type="submit" name="confirmarPass" class="btn btn-primary mb-2">Confirmar</button>
               </form>
            </div>
        </div>
    </div>';
        }              
    }
?>
               

               
               
