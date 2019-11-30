<?php
    
    include("conexion.php");
    
    if(isset($_POST['confirmarCheckin'])){

        if(isset($_GET['reserva']) && isset($_POST['ubicaciones'])){

            $codigoReserva = $_GET['reserva'];
            $ubicaciones = $_POST['ubicaciones'];
            
            
            foreach($ubicaciones as $u){
            
             echo $u;
            }

            $queryTrayecto = "SELECT t.fkCodigoLugarOrigen AS origen, t.fkCodigoLugarDestino AS destino, rvt.fkCodigoViaje AS codigoViaje
                            FROM reserva AS r INNER JOIN relacionReservaTrayecto AS rrt
                                ON r.codigo = rrt.fkCodigoReserva
                            INNER JOIN trayecto AS t
                                ON rrt.fkIdTrayecto = t.idTrayecto
                            INNER JOIN relacionViajeTrayecto AS rvt
                                ON t.idTrayecto = rvt.fkIdTrayecto
                            WHERE r.codigo = '".$codigoReserva."'";

            $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

            if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)){

                $auxDestino = $trayecto["origen"];

                for ($i = $trayecto["origen"]; $i <= $trayecto["destino"]; $i++){

                    $auxDestino++;

                    $buscarTrayecto = "SELECT * 
                                       FROM trayecto as t
                                       INNER JOIN relacionViajeTrayecto as rvt
                                            ON t.idTrayecto = rvt.fkIdTrayecto
                                       WHERE t.fkCodigoLugarOrigen =".$i." and t.fkCodigoLugarDestino =".$auxDestino." and fkCodigoViaje =".$trayecto["codigoViaje"]."";

                    $resultadoTrayecto = mysqli_query($conexion, $queryTrayecto);

                    if($trayecto = mysqli_fetch_assoc($resultadoTrayecto)) {

                        foreach($ubicaciones as $u){

                            $queryUbicacion = "UPDATE ubicacion as u
                                               SET estado = false
                                               WHERE CONCAT(u.filaUbicacion, u.columnaUbicacion) ='".$u."'";

                            $resultadoUbicacion = mysqli_query($conexion, $queryUbicacion);    
                        }    
                    }
                }    
            }

            if($resultadoUbicacion) {
                echo '<br><div class="alert alert-success mt-5" role="alert">
                            Se confirmó el checkin.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>';
            }

        }else {
             echo '<br><div class="alert alert-warning mt-5" role="alert">
                        No se seleccionaron ubicaciones.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>';
        }
    }
?>
