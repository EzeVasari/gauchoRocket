<?php
include('../Modelo/conexion.php');

$consulta = "SELECT DISTINCT t.fkcodigoLugarOrigen as codigo, l.nombre as nombre
              FROM trayecto as t INNER JOIN lugar as l ON t.fkCodigoLugarOrigen = l.codigo";
$resultado = mysqli_query($conexion, $consulta);

echo "
        <div class='container buscador p-3 mb-3 border border-info'>
            <form class='needs-validation' method='post' action='index.php'>
                <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class='fas fa-plane-departure'></i>  Origen</label>
                        <select class='custom-select' name='origen'>
                            <option selected value='0'>Seleccione origen</option>
                            ";
                            
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "
                                        <option value='". $recorrer["codigo"] ."'>". $recorrer['nombre'] ."</option>
                                     ";
                            }
                            
echo                        "
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip02'><i class='fas fa-plane-arrival'></i>  Destino</label>
                        <select class='custom-select' name='destino'>
                            <option selected value='0'>Seleccione destino</option>
                            ";
                            
                            $consulta = "SELECT DISTINCT l.nombre as nombre, t.fkCodigoLugarDestino as codigo
                                          FROM trayecto as t inner join lugar as l on t.fkCodigoLugarDestino = l.codigo";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }

echo                        "
                        </select>
                    </div>
                </div>
                
                
                
                
                
                <div class='form-row align-items-center'>
              
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip04'><i class='fas fa-layer-group'></i>  Nivel de vuelo</label>
                        <select class='custom-select' name='nivel'>
                            <option value='0' selected>Elija nivel de vuelo...</option>";
                            
                            $consulta = "select distinct tv.descripcion as nombre, tv.codigo as codigo
                                        from viaje as v inner join tipoDeViaje as tv on v.codigoTipoDeViaje = tv.codigo;";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }
                            
echo "
                        </select>
                    </div>
              
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip05'><i class='far fa-calendar-alt'></i>  Fecha</label>
                        <div class='input-group date'>
                            <input type='text' autocomplete='off' id='fecha' class='form-control' name='fecha' placeholder='DD/MM/AAAA'>
                        </div>
                    </div>
              
                    <div class='col-md-3 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscar'><i class='fas fa-search'></i>  Buscar</button>
                    </div>
                </div>
            </form>
        </div>
     ";
?>
