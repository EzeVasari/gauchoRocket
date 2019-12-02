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
        }elseif ($_GET["m"] == 4){
            echo '<br><div class="alert alert-warning mt-5" role="alert">
                    Usted es un administrador. Esa página es exclusiva para clientes.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 5){
            echo '<br><div class="alert alert-warning mt-5" role="alert">
                    Esa página es exclusiva para clientes logueados. <a class="alert-link" href="#" data-toggle="modal" data-target="#iniciar">Iniciar sesión</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 6){
            echo '<br><div class="alert alert-warning mt-5" role="alert">
                    Acceso a la página no permitido.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 7){
            echo '<br><div class="alert alert-success mt-5" role="alert">
                    Check-in realizado exitosamente.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }elseif ($_GET["m"] == 8){
            echo '<br><div class="alert alert-danger mt-5" role="alert">
                    El check-in no se ha realizado.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }
    }

    if(isset($_GET["i"])){
        
        if($_GET["i"] == 1){
            echo '<br><div class="alert alert-danger mt-1" role="alert">
                    Algunas de sus reservas fueron dadas de baja ya que el nivel de vuelo que se le asignó no se lo permite.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
        }
    }
    
    
    
    $email = ' ';
    
    if(isset($_COOKIE['login'])){    
        $usuario = $_COOKIE['login'];
    }
    
    if(isset($_POST['iniciar'])){
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        include('conexion.php');
        
        /* CREAMOS LA CONSULTA */
        $sql = "SELECT l.fkEmailUsuario AS usuario, l.pass AS pass, u.rol AS rol
                    FROM usuario AS u
                        INNER JOIN login AS l ON u.email = l.fkEmailUsuario
                    WHERE l.fkEmailUsuario = ? AND u.active = true";
        
        /* PREPARAMOS LA CONSULTA */
        $query = mysqli_prepare($conexion, $sql);
        
        /* UNIMOS LOS PARÁMETROS DETALLANDO EL TIPO DE DATO QUE VA A RECIBIR */
        /* "s" es para string */
        /* "i" es para numéricos */
        /* "d" es para decimales */
        $resultado = mysqli_stmt_bind_param($query, "s", $email);
        
        /* EJECUTAMOS LA CONSULTA */
        /* Si por alguna razón no se ejectura la consulta devolvería FALSE */
        /* PISAMOS $resultado de forma intencional ya que sólo validan TRUE/FALSE en este punto de la inyección SQL */
        $resultado = mysqli_stmt_execute($query);
        
        
        /* ASOCIAMOS VARIABLES. LOS CAMPOS DE CADA REGISTRO OBTENIDO EN LA CONSULTA EJECUTADA */
        $resultado = mysqli_stmt_bind_result($query, $mailUsuario, $mailPass, $mailRol);
        
        /* RECORREMOS LOS REGISTROS OBTENIDOS (EQUIVALE A mysqli_fetch_assoc) */
        /* mysqli_stmt_fetch */
    if(mysqli_stmt_fetch($query)){
        if($mailPass == md5($pass)){
	        $_SESSION['user'] = $email;
            setcookie('login', $email, time()+1000);
            if($mailRol == false){
                include('verificacionesDeInicioDeSesion.php');
                
                /* cerrar sentencia */
                mysqli_stmt_close($query);
                
                header("Location: ../Vista/index.php?m=1&i=".$i."");
            }else {
                /* cerrar sentencia */
                mysqli_stmt_close($query);
                
                header('Location: ../Vista/adminIndex.php?m=1');
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
                    E-mail incorrecto o no verificado. <a href="#" class="alert-link" data-toggle="modal" data-target="#iniciar">Volver a intentarlo</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </div>';
    }
        
    
    
}
    
    

?>
