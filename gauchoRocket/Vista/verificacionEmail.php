<?php
    include("../Modelo/conexion.php");
    include("head.php");
    include("navbar.php");
    include("../Modelo/iniciarSesion.php");
    include("iniciarSesion.php");
    

    
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
        $email = $_GET['email']; 
        $hash = $_GET['hash']; 
        
        $buscarUsuario = "SELECT email, hash, active FROM usuario WHERE email='".$email."' AND codigoHash='".$hash."' AND active= false") or die(mysql_error());
        $resultado = mysqli_query($conexion, $buscarUsuario);
        
        if($usuario = mysqli_fetch_assoc($resultado)){
            $actualizarUsuario = "UPDATE usuario SET active= true WHERE email='".$email."' AND codigoHash='".$hash."'" or die(mysql_error());
            $resultadoDos = mysqli_query($conexion, $actualizarUsuario);
            echo "<div class='container'>
                    <div class='alert alert-success' role='alert'>
                      <h4 class='alert-heading'>Cuenta confirmada!</h4>
                      <p>Bien, has confimado tu cuenta mediante el email <span class='font-weight-bold'>'.$email.'</span>. Ya puedes <a href='#' class='alert-link' data-toggle='modal' data-target='#iniciar'>iniciar sesión</a> y utilizar todos nuestros servicios, muchas gracias.</p>
                    </div>
                    </div>";
        }
    }else{
        echo "<div class='container'>
                    <div class='alert alert-danger' role='alert'>
                      <h4 class='alert-heading'>No se pudo!</h4>
                      <p>No has confimado tu cuenta mediante el email <span class='font-weight-bold'>'.$email.'</span>.</p>
                    </div>
                    </div>";
    }


/* echo '<br><div class="alert alert-success mt-5" role="alert">
                Registro exitoso! <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Iniciá sesión</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>'; 
            */



?>
               

               
               