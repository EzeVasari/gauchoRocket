<?php
    include("head.php");
    include('../Modelo/conexion.php');

    if(isset($_POST["registrarse"])){
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["DNI"];
        
    
    $buscarUsuario = "SELECT * FROM usuario WHERE email='" . $email . "' OR dni=".$dni;
    $resultado = mysqli_query($conexion, $buscarUsuario);
        
    
    if($user = mysqli_fetch_assoc($resultado)){
        if($user['dni'] == $dni){
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    DNI ya registrado. <a href="#" class="alert-link" data-toggle="modal" data-target="#registrar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }else{
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    E-mail ya registrado. <a href="#" class="alert-link" data-toggle="modal" data-target="#registrar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }
    }else {
        
        $codigoHash = md5(rand(0,1000));
        
        $query = "INSERT INTO usuario (email, dni, rol, nombre, apellido, codigoHash, active) VALUES ('".$email."','".$dni."','cliente','".$nombre."','".$apellido."', '".$codigoHash."', false)";
        $queryDos = "INSERT INTO login (fkEmailUsuario, pass) VALUES ('".$email."','".$pass."')";
        $queryTres = "INSERT INTO cliente (fkEmailUsuario) VALUES ('".$email."')";
    
        $insert = mysqli_query($conexion, $query);
        $insertDos = mysqli_query($conexion, $queryDos);
        $insertTres = mysqli_query($conexion, $queryTres);
        
        /* == Envio de email == */
        $asunto = "Confirmación de cuenta | Gaucho Rocket"; 

        $cuerpo = ' 
                <!DOCTYPE html>
                <html lang="">
                <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"/>
                    <script src="https://kit.fontawesome.com/06b3ad8f3c.js" crossorigin="anonymous"></script>
                    <title></title>
                </head>

                <body style="font-family: "Poppins" !important;">
                    <div class="container p-4 mb-2 bg-secondary text-white">
                     <div class="d-flex justify-content-center">
                       <h3>
                        <img src="img/cohete.png" width="25" height="25" alt="">
                        <i class="fal fa-rocket"></i>
                        Gaucho Rocket
                      </h3>
                     </div>
                     <div class="p-3 bg-white text-dark">
                        <p>Hola:</p>
                        <p>¡Gracias por registrarse en Gaucho Rocket! Por favor, haga click en el enlace de la parte inferior para confirmar su dirección de correo electrónico. Una vez que confirme su correo electrónico, puede comenzar a utilizar nuestro servicio.</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary" href="C:\xampp\htdocs\gauchoRocket\gauchoRocket\Vista\verificacionEmail.php?email='.$email.'&hash='.$codigoHash.'" role="button" style="background-color: #AD84C7 !important; border-color: #AD84C7 !important;">Confirmar cuenta</a>
                        </div>
                        <p class="mt-2">
                        Gracias,<br>
                        El equipo de <span class="font-weight-bold">Gaucho Rocket</span>.
                        </p>
                        <p class="font-italic">
                        Si no puede ver el botón de confirmación de arriba, aquí tiene el enlace de confirmación: C:\xampp\htdocs\gauchoRocket\gauchoRocket\Vista\verificacionEmail.php?email='.$email.'&hash='.$codigoHash.'
                        </p>
                     </div>
                    </div>
                </body>
                </html>
 
                ';
                
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
                

        mail($email,$asunto,$cuerpo,$headers);
                    
        
        /* == Fin envio de email == */
        
    if(($insert == TRUE) && ($insertDos == TRUE) && ($insertTres == TRUE)) {
        echo '<br><div class="alert alert-success mt-5" role="alert">
                ¡Registro exitoso! Te enviamos un email de confirmación a '. $email .'.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>';
    }else {
        echo '<br><div class="alert alert-danger mt-5" role="alert">
                Registro fallido!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>';
    }
        
        
        
        
    }
    }

?>
