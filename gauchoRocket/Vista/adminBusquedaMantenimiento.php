<?php
include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
   

    
    if(isset($_POST["buscar"])){
        
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        
        
        $fecha = $_POST["fecha"]; //27-10-2019
        $anio = substr($fecha, -4);
        $mes = substr($fecha, 3, -5);
        $dia = substr($fecha, 0, -8);
        $fechaAComparar = "$anio.$mes.$dia";
        
        
        
/* ======================================== */
        
        $query = "SELECT * FROM viaje";
        $criterio = "";

        if(!empty($origen) || $origen != 0){
            $criterio = " where codigoLugarorigen = ".$origen;
        }
        
        if(!empty($destino) || $destino != 0){
            if($criterio == ""){
                $criterio = " where codigoLugardestino = ".$destino;
            }else{
                $criterio .= " and codigoLugardestino = ".$destino;
            }
        }
        
        if(!empty($fecha) || $fecha=""){
            if($criterio == ""){
                $criterio = " where date(fecha) = '".$fechaAComparar."'";
            }else{
                $criterio .= " and date(fecha) = '".$fechaAComparar."'";
            }
        }
        
        
        
        $query .= $criterio;
        
/* ======================================== */
        
        
        
        $resultado = mysqli_query($conexion, $query);
        
        if(mysqli_num_rows($resultado) >= 1) {
            include("../Vista/adminMantenimiento2.php");
        }else{
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    No se encontró ningún viaje!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </div>";
            $query = "SELECT * FROM viaje GROUP BY nombre";
            
            $resultado = mysqli_query($conexion, $query);
        include("../Vista/adminMantenimiento2.php");
        }
    }else{
        $query = "SELECT * FROM viaje GROUP BY nombre";
        
        $resultado = mysqli_query($conexion, $query);
        include("../Vista/admiMantenimiento2.php");
    }
?>