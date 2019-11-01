<?php
include('../Modelo/conexion.php');

$consulta = "SELECT DISTINCT v.origen as codigo, l.nombre as nombre
              FROM viaje as v inner join lugar as l on v.origen = l.codigo";
$resultado = mysqli_query($conexion, $consulta);

echo "
        <div class='container buscador p-3 mb-3 border border-info'>
            <form class='needs-validation' method='post' action='index.php'>
                <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'>Origen</label>
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
                        <label class='font-weight-bold' for='validationTooltip02'>Destino</label>
                        <select class='custom-select' name='destino'>
                            <option selected value='0'>Seleccione destino</option>
                            ";
                            
                            $consulta = "SELECT DISTINCT l.nombre as nombre, v.destino as codigo
                                          FROM viaje as v inner join lugar as l on v.destino = l.codigo";
                            $resultado = mysqli_query($conexion, $consulta);
                            while($recorrer = mysqli_fetch_assoc($resultado)){
                                echo "<option value='". $recorrer["codigo"] ."'>". $recorrer["nombre"] ."</option>";
                            }

echo                        "
                        </select>
                    </div>
                </div>
                
                
                
                
                
                <div class='form-row align-items-center'>
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip03'>Pasajeros/as</label>
                        <select class='custom-select' name='pasajeros'>
                            <option value='1' selected>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                        </select>
                    </div>
              
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip04'>Nivel de vuelo</label>
                        <select class='custom-select' name='nivel'>
                            <option value='1' selected>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                        </select>
                    </div>
              
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip05'>Fecha</label>
                        <div class='input-group date'>
                            <input type='text' autocomplete='off' id='fecha' class='form-control' name='fecha' placeholder='DD/MM/AAAA'>
                        </div>
                    </div>
              
                    <div class='col-md-3 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscar'><i class='fas fa-search'></i> Buscar</button>
                    </div>
                </div>
            </form>
        </div>
     ";
?>
