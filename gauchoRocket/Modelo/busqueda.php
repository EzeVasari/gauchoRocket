<?php
    include('../Vista/busquedaVista.php');
    include('conexion.php');
    
    if(isset($_POST["buscar"])){
        
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $nivel = $_POST["nivel"];
        
        $fecha = $_POST["fecha"]; //27-10-2019
        $anio = substr($fecha, -4);
        $mes = substr($fecha, 3, -5);
        $dia = substr($fecha, 0, -8);
        $fechaAComparar = "$anio.$mes.$dia";
        
        
        
/* ======================================== */
        
        $query = "SELECT v.imagen as imagen, v.descripcion as descripcion, t.precio as precio, v.codigo as codigo, t.nombreTrayecto as nombre
                    FROM trayecto as t INNER JOIN relacionViajeTrayecto as rvt
                        ON t.idTrayecto = rvt.fkIdTrayecto
                    INNER JOIN viaje as v
                        ON rvt.fkCodigoViaje = v.codigo";
        $criterio = "";

        if(!empty($origen) || $origen != 0){
            $criterio = " where t.fkCodigoLugarorigen = ".$origen;
        }
        
        if(!empty($destino) || $destino != 0){
            if($criterio == ""){
                $criterio = " where t.fkCodigoLugardestino = ".$destino;
            }else{
                $criterio .= " and t.fkCodigoLugardestino = ".$destino;
            }
        }
        
        if(!empty($fecha) || $fecha=""){
            if($criterio == ""){
                $criterio = " where v.date(fecha) = '".$fechaAComparar."'";
            }else{
                $criterio .= " and v.date(fecha) = '".$fechaAComparar."'";
            }
        }
        
        if(!empty($nivel) || $nivel=""){
            if($criterio == ""){
                $criterio = " where v.codigoTipoDeViaje = '".$nivel."'";
            }else{
                $criterio .= " and v.codigoTipoDeViaje = '".$nivel."'";
            }
        }
        
        $query .= $criterio;
        
/* ======================================== */
        
        
        
        $resultado = mysqli_query($conexion, $query);
        
        if(mysqli_num_rows($resultado) >= 1) {
            include("../Vista/cards.php");
        }else{
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    No se encontró ningún viaje!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </div>";
            $query = "SELECT v.imagen as imagen, v.descripcion as descripcion, t.precio as precio, v.codigo as codigo, t.nombreTrayecto as nombre 
                        FROM trayecto as t INNER JOIN relacionViajeTrayecto as rvt
                            ON t.idTrayecto = rvt.fkIdTrayecto
                        INNER JOIN viaje as v
                            ON rvt.fkCodigoViaje = v.codigo";
            
            $resultado = mysqli_query($conexion, $query);
        include("../Vista/cards.php");
        }
    }else{
        $query = "SELECT v.imagen as imagen, v.descripcion as descripcion, t.precio as precio, v.codigo as codigo, t.nombreTrayecto as nombre
                FROM trayecto as t INNER JOIN relacionViajeTrayecto as rvt
                    ON t.idTrayecto = rvt.fkIdTrayecto
                INNER JOIN viaje as v
                    ON rvt.fkCodigoViaje = v.codigo";
        
        $resultado = mysqli_query($conexion, $query);
        include("../Vista/cards.php");
    }
?>
