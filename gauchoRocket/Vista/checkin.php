<?php
    include("../Modelo/validarPaginasParaClientes.php");
    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    include('../Modelo/validacionCheckin.php');
    
    if(!isset($_POST['confirmarCheckin'])) {
        
        $reserva = $_GET["reserva"];
        $codigoVuelo = $_GET["vuelo"];
        $cabina = $_GET["cabina"];
        $origen = $_GET["origen"];
        $destino = $_GET["destino"];

        $buscarUbicacion = "SELECT * 
                            FROM ubicacion as u
                                INNER JOIN trayecto as t ON u.fkIdTrayecto = t.idTrayecto
                            WHERE fkCodigoCabina = ".$cabina."
                                and fkCodigoViaje = ".$codigoVuelo."
                                and t.fkCodigoLugarOrigen = ".$origen."
                                and t.fkCodigoLugarDestino = ".$destino."
                                and u.fkCodigoReserva like '".$reserva."';";

        $buscarCabina = "SELECT tdc.descripcion as descripcion
                         FROM viaje as v
                            INNER JOIN equipo as e ON v.matriculaEquipo = e.matricula
                            INNER JOIN relacionCabinaEquipo as rce ON e.matricula = rce.fkMatriculaEquipo
                            INNER JOIN cabina as c ON rce.fkCodigoCabina = c.codigoCabina
                            INNER JOIN tipoDeCabina as tdc ON tdc.codigoTipoDeCabina = c.fkCodigoTipoDeCabina
                         WHERE c.codigoCabina = ".$cabina." and v.codigo = ".$codigoVuelo."";
        
        
        /* ============================================================ */
        $asientosTotales = "select (e.capacidadSuit + e.capacidadGeneral + e.capacidadFamiliar + 1) as asientosTotales
                            from reserva as r
	                           inner join ubicacion as u on u.fkCodigoReserva = r.codigo
                               inner join viaje as v on u.fkCodigoViaje = v.codigo
                               inner join equipo as e on v.matriculaEquipo = e.matricula
                            where r.codigo like '".$reserva."'";
        $resultadoAsientos = mysqli_query($conexion, $asientosTotales);
        /* ============================================================ */
        

        $resultadoUbicacion = mysqli_query($conexion, $buscarUbicacion);
        $resultadoCabina = mysqli_query($conexion, $buscarCabina);

        $cabinaArray = mysqli_fetch_assoc($resultadoCabina);
        
        $queryLimite = "select count(*) as resultado
                        from relacionClienteItemReserva as rel
	                       inner join itemReserva as ir on rel.fkIdItemReserva = ir.idItemReserva
	                       inner join reserva as r on ir.fkcodigoReserva = r.codigo
                        where r.codigo like '".$reserva."';";
        $resultadoLimite = mysqli_query($conexion, $queryLimite);
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
                                <h4 class="font-weight-bold text-center">'.$cabinaArray["descripcion"].'</h4>
                                <form name="ordenamiento" id="contenedor" action="checkin.php?reserva='.$reserva.'" method="post">
                                <input type="hidden" id="cantidad" value='.$limite.'>
                                    ';
        
                                        while($result = mysqli_fetch_assoc($resultadoAsientos)){
                                            for($i = 1; $i < $result['asientosTotales']; $i++){
                                                if ((($i-1) % 10) == 0){
                                                    echo "<div class='row'>";
                                                }
                                                
                                                echo "<div class='col seat'>
                                                        <input type='checkbox' id='".$i."' value='".$i."' name='registro[]'>
                                                        <label class='text-center' for='".$i."'> ".$i." </label>
                                                      </div>";
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
        

