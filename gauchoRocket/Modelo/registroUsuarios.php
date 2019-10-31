<?php
    include("head.php");

    if(isset($_POST["registrarse"])){
    $nick = $_POST["usuario"];
    $pass = md5($_POST["pass"]);
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["DNI"];
        
    $conexion = mysqli_connect("localhost", "root", "", "gauchorocket");

    $buscarUsuario = "SELECT * FROM USUARIO WHERE DNI='" . $dni . "'";
    $resultado = mysqli_query($conexion, $buscarUsuario);
        
    
    
    if($user = mysqli_fetch_assoc($resultado)){
        if($user['nick'] == $nick){
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    Usuario ya elegido. <a href="#" class="alert-link" data-toggle="modal" data-target="#registrar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }else{
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    DNI ya registrado. <a href="#" class="alert-link" data-toggle="modal" data-target="#registrar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }
    }else {
        $query = "INSERT INTO USUARIO (nick, dni, rol, nombre, apellido) VALUES ('".$nick."','".$dni."','cliente','".$nombre."','".$apellido."')";
        $queryDos = "INSERT INTO LOGIN (fknick, email, pass) VALUES ('".$nick."','".$email."','".$pass."')";
    
        $insert = mysqli_query($conexion, $query);
        $insertDos = mysqli_query($conexion, $queryDos);
        
    if(($insert == TRUE) && ($insertDos == TRUE)) {
        echo '<br><div class="alert alert-success mt-5" role="alert">
                Registro exitoso! <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Iniciá sesión</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>';
    }
    }
    }

?>
