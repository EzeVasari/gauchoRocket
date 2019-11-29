<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
    include('../Modelo/registroUsuarios.php');
    include('registroUsuarios.php');
    include('../Modelo/validacionCheckin.php');

    $codigoVuelo = $_GET["vuelo"];
    $origen = $_GET["origen"];
    $destino = $_GET["destino"];
    $cabina = $_GET["cabina"];
    
    $buscarUbicacion = "SELECT * 
                        FROM ubicacion as u INNER JOIN trayecto as t
                            ON u.fkIdTrayecto = t.idTrayecto
                        WHERE fkCodigoCabina = ".$cabina." and fkCodigoViaje = ".$codigoVuelo." and t.fkCodigoLugarOrigen =".$origen." and t.fkCodigoLugarDestino =".$destino."";

    $buscarCabina = "SELECT tdc.descripcion as descripcion
                    FROM viaje as v INNER JOIN equipo as e
                        ON v.matriculaEquipo = e.matricula
                    INNER JOIN relacionCabinaEquipo as rce
                        ON e.matricula = rce.fkMatriculaEquipo
                    INNER JOIN cabina as c
                        ON rce.fkCodigoCabina = c.codigoCabina
                    INNER JOIN tipoDeCabina as tdc
                        ON tdc.codigoTipoDeCabina = c.fkCodigoTipoDeCabina
                    WHERE c.codigoCabina = ".$cabina." and v.codigo =".$codigoVuelo."";
                        
    $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
    $resultadoCabina = mysqli_query($conexion, $buscarCabina);

    $cabinaArray = mysqli_fetch_assoc($resultadoCabina);
?>


<body>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
   
   <script type="text/javascript" src="js/checkbox.js"></script>
    <link rel="stylesheet" href="css/estilosCheckin.css">
   <div class="container" style="margin-top: 5rem;">
           <h3 class="font-weight-bold text-center" >Check-in</h3>
            <div class="row justify-content-center" id="tabla">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg" >
                    <h4 class="font-weight-bold">Seleccion de ubicacion</h4>
                    <p class="text-muted">Seleccione los asientos que desea ocupar</p>
                    <h4 class="font-weight-bold text-center"><?php $cabinaArray["descripcion"]?></h4>
                    <form id="contenedor" action="checkin.php" method="post">
                    
                        
                    <?php 
    
                        
                        
                        echo "<div class='row justify-content-center'>";
                        while($asientos = mysqli_fetch_assoc($resultadoUbicacion)){
                            
                            if($asientos["estado"] == false){
                                echo '<div class="seat">';
                                echo '<input type="checkbox" value="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'" name="ubicaciones[]" id="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'" disabled />';
                                echo '<label class="text-center" for="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'">'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'</label>';
                                echo '</div>';
                            }else {
                                echo '<div class="seat">';
                                echo '<input type="checkbox" value="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'" name="ubicaciones[]" id="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'"/>';
                                echo '<label class="text-center"for="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'">'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'</label>';
                                echo '</div>';
                            }
                        }
                        
                        echo "</div>";
                          
                    ?>   
                   </div>
                </div>
            <div class="row mt-2 justify-content-center">
              <div class="col-md-6 mt-2 mb-3">
               <button class='btn btn-primary w-100 text-white mt-3' type='submit' name='confirmarCheckin'>Confirmar reserva</button>
               </div>
            </form>
            </div>
                
    </div>
      
    
</body>