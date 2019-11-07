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
                </head>
              
                <body style="font-family: sans-serif !important;">
                    <div style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; @media (min-width: 576px) { max-width: 540px; }; @media (min-width: 768px) { max-width: 720px;}; @media (min-width: 992px) { max-width: 960px;}; padding: 1.5rem !important; margin-bottom: 0.5rem !important; @page { min-width: 992px !important;}; background-color: #A08DD7 !important; color: #fff !important;">
                     <div style="display: -ms-flexbox !important; display: flex !important; -ms-flex-pack: center !important; justify-content: center !important;">
                       <h2>
                        <img src="http://localhost/gauchoRocket/gauchoRocket/Vista/img/cohete.png" width="25" height="25" alt="">
                        Gaucho Rocket
                      </h2>
                     </div>
                     <div style="padding: 1rem !important; background-color: #fff !important; color: #343a40 !important;">
                        <p>Hola:</p>
                        <p>¡Gracias por registrarse en Gaucho Rocket! Por favor, haga click en el enlace de la parte inferior para confirmar su dirección de correo electrónico. Una vez que confirme su correo electrónico, puede comenzar a utilizar nuestro servicio.</p>
                        <div style="display: -ms-flexbox !important; display: flex !important; -ms-flex-pack: center !important; justify-content: center !important;">
                            <a href="http://localhost/gauchoRocket/gauchoRocket/Vista/verificacionEmail.php?email='.$email.'&hash='.$codigoHash.'" role="button" style="display: inline-block; font-weight: 400; color: #212529; text-align: center; vertical-align: middle; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; background-color: transparent; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; color: #fff; background-color: #AD84C7 !important; border-color: #AD84C7 !important; text-decoration: none !important;">Confirmar cuenta</a>
                        </div>
                        <p style="margin-top: 0.5rem !important;">
                        Gracias,<br>
                        El equipo de <span style="font-weight: 700 !important;">Gaucho Rocket</span>.
                        </p>
                        <p style="font-style: italic !important;">
                        Si no puede ver el botón de confirmación de arriba, aquí tiene el enlace de confirmación: http://localhost/gauchoRocket/gauchoRocket/Vista/verificacionEmail.php?email='.$email.'&hash='.$codigoHash.'
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
