<?php
    session_start();
    
    if(isset($_COOKIE['login'])) { 
        setcookie('login',$usuario, time()-1000); 
    } 

    session_destroy();
    header("Location: index.php?m=2");
    exit();
?>
