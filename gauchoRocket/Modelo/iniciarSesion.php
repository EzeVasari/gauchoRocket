<?php
    
    if(isset($_GET["m"])){
        if($_GET["m"] == 1){
            echo '<br><div class="alert alert-success mt-5" role="alert">
                    Bienvenido/a
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 2){
            echo '<br><div class="alert alert-success mt-5" role="alert">
                    Ha cerrado sesión.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 3){
            echo '<br><div class="alert alert-warning mt-5" role="alert">
                    Debes iniciar sesión para reservar. <a class="alert-link" href="#" data-toggle="modal" data-target="#iniciar">Iniciar sesión</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
            
        }

    }
       
    
    $usuario = ' ';
    
    if(isset($_COOKIE['login'])){    
        $usuario = $_COOKIE['login'];
    }
    
    if(isset($_POST['iniciar'])){
        $usuario = $_POST["usuario"];
        $pass = $_POST["pass"];

        include('conexion.php');

        $query = "SELECT l.fkNickUsuario AS usuario, l.pass AS pass, u.rol AS rol
                    FROM usuario AS u INNER JOIN login AS l ON u.nick = l.fkNickUsuario
                    WHERE l.fkNickUsuario = '" . $usuario . "'";
        $resultado = mysqli_query($conexion, $query);
    
    if($row = mysqli_fetch_assoc($resultado)){
        if($row["pass"] == md5($pass)){
            session_start();
	        $_SESSION['user'] = $usuario;
            setcookie('login',$usuario,time()+1000);
            if($row["rol"] == false){
                header('Location: ../Vista/index.php?m=1');
            }else {
                header('Location: ../Vista/indexAdmin.php?m=1');
            }
            
        }else{
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    Contraseña incorrecta. <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }
    }else{
        echo '<br><div class="alert alert-danger mt-5" role="alert">
                    Usuario incorrecto. <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    }
        
    
    
}
    
    

?>
