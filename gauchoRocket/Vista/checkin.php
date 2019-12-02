<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    include('../Modelo/validacionCheckin.php');
    
    if(!isset($_POST['confirmarCheckin'])) {
        
        $reserva = $_GET["reserva"];
        $codigoViaje = $_GET["viaje"];
        
        /* ============================================================ */
        
        $buscarCodigoCabina = "SELECT ir.fkCodigocabina as codigoCabina
                                FROM reserva as r INNER JOIN itemReserva as ir
                                    ON r.codigo = ir.fkCodigoReserva
                                WHERE r.codigo = '".$reserva."'";
        
        $resultadoCodigoCabina = mysqli_query($conexion, $buscarCodigoCabina);
        $codigoCabina = mysqli_fetch_assoc($resultadoCodigoCabina);
        
        /* ============================================================ */
        
        $buscarNombreCabina = "SELECT tdc.descripcion as nombreCabina 
                         FROM viaje as v
                            INNER JOIN equipo as e ON v.matriculaEquipo = e.matricula
                            INNER JOIN relacionCabinaEquipo as rce ON e.matricula = rce.fkMatriculaEquipo
                            INNER JOIN cabina as c ON rce.fkCodigoCabina = c.codigoCabina
                            INNER JOIN tipoDeCabina as tdc ON tdc.codigoTipoDeCabina = c.fkCodigoTipoDeCabina
                         WHERE c.codigoCabina = ".$codigoCabina["codigoCabina"]." and v.codigo = ".$codigoViaje."";
        
        $resultadoNombreCabina = mysqli_query($conexion, $buscarNombreCabina);
        $nombreCabina = mysqli_fetch_assoc($resultadoNombreCabina);
        
        /* ============================================================ */
        
        $buscarOrigenDestino = "SELECT t.fkCodigoLugarOrigen as origen, t.fkCodigoLugarDestino as destino
                         FROM reserva as r INNER JOIN relacionReservaTrayecto as rrt
                            ON r.codigo = rrt.fkCodigoReserva 
                         INNER JOIN trayecto as t 
                            ON rrt.fkIdTrayecto = t.idTrayecto
                         WHERE r.codigo = '".$reserva."'";
        
        $resultadoOrigenDestino = mysqli_query($conexion, $buscarOrigenDestino);
        $OrigenDestino = mysqli_fetch_assoc($resultadoOrigenDestino);
        
        
        $buscarUbicacion = "SELECT * 
                            FROM ubicacion as u
                                INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
                            WHERE fkCodigoCabina = ".$codigoCabina["codigoCabina"]."
                                and fkCodigoViaje = ".$codigoViaje."
                                and t.fkCodigoLugarOrigen = ".$OrigenDestino['origen']."
                                and t.fkCodigoLugarDestino = ".$OrigenDestino['destino']."
                                and u.fkCodigoReserva like '".$reserva."' and ;";
        
        $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
        
        /* ============================================================ */
        
        $asientosTotales = "select e.capacidadSuit as suite, e.capacidadGeneral as general, e.capacidadFamiliar as familiar
                            from viaje as v
                               inner join equipo as e on v.matriculaEquipo = e.matricula
                            where v.codigo = ".$codigoViaje."";
        $resultadoAsientos = mysqli_query($conexion, $asientosTotales);
        
        /* ============================================================ */
    
        $queryLimite = "select count(*) as resultado
                        from relacionClienteItemReserva as rel
	                       inner join itemReserva as ir on rel.fkIdItemReserva = ir.idItemReserva
	                       inner join reserva as r on ir.fkcodigoReserva = r.codigo
                        where r.codigo like '".$reserva."';";
        
        $resultadoLimite = mysqli_query($conexion, $queryLimite);
        
        /* ============================================================ */
        
        $limite = 0;
        
        while($rowLimite = mysqli_fetch_assoc($resultadoLimite)){
            $limite = $rowLimite['resultado'];
        }
        
        echo'<body>
              <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
              <script>
                    $(document).ready(function(){
	                    $("input[type=checkbox]").change(function(){
                            var elemento=this;
                            var contador=0;
                        
                            $("input[type=checkbox]").each(function(){
                                if($(this).is(":checked"))
                                contador++;
		                    });
        
		                    var cantidadMaxima=parseInt($("#cantidad").val()) || 0;
        
		                    if(contador>cantidadMaxima){
                                $(elemento).prop("checked", false);
                                contador--;
		                    }
                        });
                    });
              </script>
              <link rel="stylesheet" href="css/estilosCheckin.css">
              
                    <div class="container" style="margin-top: 5rem;">
                       <h3 class="font-weight-bold">Check-in</h3>
                        <div class="row" id="tabla">
                            <div class="col-md-7 bg-light p-3 border border-primary rounded-lg" >
                                <h4 class="font-weight-bold">Selección de ubicación</h4>
                                <p class="text-muted">Seleccione los asientos que desea ocupar</p>
                                <h4 class="font-weight-bold text-center">'.$nombreCabina["nombreCabina"].'</h4>
                                <form name="ordenamiento" id="contenedor" action="checkin.php?reserva='.$reserva.'&cabina='.$codigoCabina["codigoCabina"].'" method="post">
                                <input type="hidden" id="cantidad" value='.$limite.'>
                                    ';
                                    while($result = mysqli_fetch_assoc($resultadoAsientos)){
                                        
                                        if ($codigoCabina["codigoCabina"] == 1){
                                            $asientosTotales = $result["general"];
                                        }elseif ($codigoCabina["codigoCabina"] == 2){
                                            $asientosTotales = $result["familiar"];
                                        }else {
                                            $asientosTotales = $result["suite"];
                                        }
                                        
                                        for($i = 1; $i < $asientosTotales +1; $i++){
                                            if ((($i-1) % 10) == 0){
                                                echo "<div class='row'>";
                                            }
                                            $buscarUbicacion = "SELECT u.nroUbicacion as nro
                                                                FROM ubicacion as u
                                                                    INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
                                                                WHERE fkCodigoCabina = ".$codigoCabina["codigoCabina"]."
                                                                    and fkCodigoViaje = ".$codigoViaje."
                                                                    and t.fkCodigoLugarOrigen = ".$OrigenDestino['origen']."
                                                                    and t.fkCodigoLugarDestino = ".$OrigenDestino['destino']."
                                                                    and u.fkCodigoReserva like '".$reserva."' and nroUbicacion =".$i;

                                            $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
                                            $ubicacion = mysqli_fetch_assoc($resultadoUbicacion);
                                            
                                            if($ubicacion['nro'] == $i){
                                                echo "<div class='col seat'>
                                                    <input type='checkbox' id='".$i."' value='".$i."' name='ubicaciones[]' disabled>
                                                    <label class='text-center' for='".$i."'> ".$i." </label>
                                                  </div>";
                                            } else {
                                                echo "<div class='col seat'>
                                                    <input type='checkbox' id='".$i."' value='".$i."' name='ubicaciones[]'>
                                                    <label class='text-center' for='".$i."'> ".$i." </label>
                                                  </div>";
                                            }
                                            
                                            /*
                                            <div class='col seat'>
                                                <input type='checkbox' id='".$i."' value='".$i."' name='registro[]' onclick='seleccionados()'>
                                                <label class='text-center' for='".$i."'> ".$i." </label>
                                            </div>
                                            */

                                            if ((($i) % 10) == 0){
                                                echo "</div>";
                                            }
                                            /*
                                            if($asientos["estado"] == false){
                                                echo '<div class="seat">';
                                                echo '<input
                                                        type="checkbox"
                                                        value="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'"
                                                        name="ubicaciones[]"
                                                        id="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'"
                                                        disabled
                                                        />';
                                                echo '<label class="text-center" for="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'">'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'</label>';
                                                echo '</div>';
                                            }else {
                                                echo '<div class="seat">';
                                                echo '<input type="checkbox" value="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'" name="ubicaciones[]" id="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'"/>';
                                                echo '<label class="text-center"for="'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'">'.$asientos["filaUbicacion"],$asientos["columnaUbicacion"].'</label>';
                                                echo '</div>';
                                            }
                                            */
                                        }
                                    }
                            echo '</div>

                            </div>
                            <div class="col-md-7 bg-light p-3 border border-primary rounded-lg">
            <h4 class="font-weight-bold">Viaje</h4>
            <p class="text-muted"></p>

            <div class="form-row">
                <div class="form-group col-md-6">
                <p><span class="font-weight-bold">Trayecto: 1</span><p>
                </div>

                <div class="form-group col-md-6">

                </div>
            </div>
        </div>
                            
                            <div class="col-md-6 mt-2 mb-3">
                                <button class="btn btn-primary w-100 text-white mt-3" type="submit" name="confirmarCheckin">Confirmar check-in</button>
                           </div>
                            </form>
                        </div>
                        
                </div>


            </body>';
        
    }
?>
        

