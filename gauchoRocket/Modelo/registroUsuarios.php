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
        $query = "INSERT INTO usuario (email, dni, rol, nombre, apellido) VALUES ('".$email."','".$dni."','cliente','".$nombre."','".$apellido."')";
        $queryDos = "INSERT INTO login (fkEmailUsuario, pass) VALUES ('".$email."','".$pass."')";
        $queryTres = "INSERT INTO cliente (fkEmailUsuario) VALUES ('".$email."')";
    
        $insert = mysqli_query($conexion, $query);
        $insertDos = mysqli_query($conexion, $queryDos);
        $insertTres = mysqli_query($conexion, $queryTres);
        
    if(($insert == TRUE) && ($insertDos == TRUE) && ($insertTres == TRUE)) {
        echo '<br><div class="alert alert-success mt-5" role="alert">
                Registro exitoso! <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Iniciá sesión</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>';
    }
    }
    }

?>
