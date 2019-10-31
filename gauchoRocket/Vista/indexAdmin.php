<!DOCTYPE html>
<html>
<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: index.php");
        exit();
    }
    
    include('head.php');
    include('navbarAdmin.php');
    
    
?>

</html>

