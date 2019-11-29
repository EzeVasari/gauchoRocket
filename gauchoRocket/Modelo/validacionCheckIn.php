<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
    include('../Modelo/registroUsuarios.php');
    include('registroUsuarios.php');

    if(isset($_POST['reserva'])){
    
        $codigReserva = $_GET['reserva'];
        $ubicaciones = $_POST['ubicaciones'];


        $queryTrayecto = "SELECT t.fkCodigoLugarOrigen AS origen, t.fkCodigoLugarDestino AS destino, rvt.fkCodigoViaje AS codigoViaje
                        FROM reserva AS r INNER JOIN relacionReservaTrayecto AS rrt
                            ON r.codigo = rrt.fkCodigoReserva
                        INNER JOIN trayecto AS t
                            ON rrt.fkIdTrayecto = t.idTrayecto
                        INNER JOIN relacionViajeTrayecto AS rvt
                            ON t.idTrayecto = rvt.fkIdTrayecto
                        WHERE r.codigo = '".$codigReserva."'";
        
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
                    
                    for()
                    $queryUbicacion = "SELECT count(filaUbicacion) as disponibles
                                      FROM ubicacion as u INNER JOIN trayecto as t
                                       ON u.fkIdTrayecto = t.idTrayecto
                                      WHERE estado = true and fkCodigoCabina = ".$cabina." and fkCodigoViaje = ".$codigo." and t.fkCodigoLugarOrigen =".$i." and t.fkCodigoLugarDestino =".$auxDestino."";
                    
                    $resultadoAsientos = mysqli_query($conexion, $queryAsientos);
                    $asientos = mysqli_fetch_assoc($resultadoAsientos);
                    
                }
            }
            
            
            
            
            
        }
        
        

    
    }

?>
