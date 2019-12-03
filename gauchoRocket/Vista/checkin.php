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
        
        $buscarNombreServicio = "SELECT tds.descripcion as nombreServicio
                         FROM reserva as r
                            INNER JOIN itemReserva as ir ON r.codigo = ir.fkCodigoReserva
                            INNER JOIN servicio as s ON ir.fkCodigoServicio = s.codigoServicio
                            INNER JOIN tipoDeServicio as tds ON tds.codigoTipoDeServicio = s.fkCodigoTipoDeServicio
                         WHERE r.codigo = '".$reserva."'";
        
        $resultadoNombreServicio = mysqli_query($conexion, $buscarNombreServicio);
        $nombreServicio = mysqli_fetch_assoc($resultadoNombreServicio);
        
        /* ============================================================ */
        
        $buscarOrigenDestino = "SELECT t.fkCodigoLugarOrigen as origen, t.fkCodigoLugarDestino as destino
                         FROM reserva as r INNER JOIN relacionReservaTrayecto as rrt
                            ON r.codigo = rrt.fkCodigoReserva 
                         INNER JOIN trayecto as t 
                            ON rrt.fkIdTrayecto = t.idTrayecto
                         WHERE r.codigo = '".$reserva."'";
        
        $resultadoOrigenDestino = mysqli_query($conexion, $buscarOrigenDestino);
        $OrigenDestino = mysqli_fetch_assoc($resultadoOrigenDestino);
        
        
        $buscarUbicacion = "SELECT t.nombreTrayecto as nombre 
                            FROM ubicacion as u
                                INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
                            WHERE fkCodigoViaje = ".$codigoViaje."
                                and t.fkCodigoLugarOrigen = ".$OrigenDestino['origen']."
                                and t.fkCodigoLugarDestino = ".$OrigenDestino['destino']."";
        
        $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
        $trayecto = mysqli_fetch_assoc($resultadoUbicacion);
        
        /* ============================================================ */
        
        $asientosTotales = "select e.capacidadSuit as suite, e.capacidadGeneral as general, e.capacidadFamiliar as familiar, e.modelo as modeloEquipo
                            from viaje as v
                            inner join equipo as e 
                                on v.matriculaEquipo = e.matricula
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
        
        function siguienteLetra($letter){
            for($x = $letter; $x < 'ZZZ'; $x++){
                $x++;
                $next = $x;
                break;
            }
            return $next;
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
                        <h3 class="font-weight-bold text-center">Check-in</h3>
                        <div class="row justify-content-center" id="tabla">
                            <div class="col-md-5 bg-light p-3 mt-2 mb-3 border border-primary rounded-lg align-self-center">
                                <h4 class="font-weight-bold">'.$trayecto["nombre"].'</h4>
                                <p class="text-muted"></p>

                                <div class="form-row">
                                    <div class="col-md-12">
                                        <p><span class="font-weight-bold"><i class="fas fa-ticket-alt"></i> Reserva:</span> '.$reserva.'</p>
                                    </div>
                                    <div class=" col-md-6">
                                        <p><span class="font-weight-bold"><i class="fas fa-door-closed"></i> Cabina:</span> '.$nombreCabina["nombreCabina"].'</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span class="font-weight-bold"><i class="fas fa-concierge-bell"></i> Servicio:</span> '.$nombreServicio["nombreServicio"].'</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><span class="font-weight-bold"><i class="fas fa-user"></i> Cant. de ubicaciones:</span> '.$limite.'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        <div class="row justify-content-center" id="tabla">
                            <div class="col-md-7 bg-light p-3 border border-primary rounded-lg" >
                                <h5 class="font-weight-bold">Selección de ubicación</h5>
                                <p class="text-muted">Seleccione los asientos que desea ocupar</p>
                                <h5 class="font-weight-bold text-center">'.$nombreCabina["nombreCabina"].'</h5>
                                <form name="ordenamiento" id="contenedor" action="checkin.php?reserva='.$reserva.'&cabina='.$codigoCabina["codigoCabina"].'&viaje='.$codigoViaje.'" method="post">
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
                                        $letra = "A";
                                        $numero = 1;
                                        
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
                                                                    and u.fkCodigoReserva like '".$reserva."' and nroUbicacion = '". $letra.$numero."'";

                                            $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
                                            $ubicacion = mysqli_fetch_assoc($resultadoUbicacion);
                                            
                                            if($ubicacion['nro'] == $letra.$numero){
                                                echo "<div class='col seat'>
                                                    <input type='checkbox' id='".$letra.$numero."' value='".$letra.$numero."' name='ubicaciones[]' disabled>
                                                    <label class='text-center' for='".$letra.$numero."'> ".$letra.$numero." </label>
                                                  </div>";
                                            } else {
                                                echo "<div class='col seat'>
                                                    <input type='checkbox' id='".$letra,$numero."' value='".$letra.$numero."' name='ubicaciones[]'>
                                                    <label class='text-center' for='".$letra.$numero."'> ".$letra.$numero." </label>
                                                  </div>";
                                            }
                                            
                                                $numero++;
                                            
                                            if ((($i) % 10) == 0){
                                                echo "</div>";
                                                $letra = siguienteLetra($letra);
                                                $numero = 1;
                                            }
                                          
                                        }
                                    }
       
                            echo ' </div>

                                </div>
                            </div>
                            <div class="row justify-content-center" id="tabla">
                                <div class="col-md-7 mt-2 mb-3">
                                    <button class="btn btn-primary w-100 text-white mt-3" type="submit" name="confirmarCheckin">Confirmar check-in</button>
                               </div>
                            </form>
                        </div>
                        
                </div>


            </body>';
        
    }

?>   

