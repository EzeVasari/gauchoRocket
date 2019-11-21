<!DOCTYPE html>
<html>
<?php
    include('../Modelo/validarPaginasParaAdministradores.php');
    include('head.php');
    include('adminNavbar.php');
    include('../Modelo/iniciarSesion.php');
    include('../Modelo/conexion.php');
?>

    <body>
        <br><br><br><br><br><br><br>
        <div class='container buscador p-3 mb-3 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de generación de facturas</h2>
                    <p class="text-muted">
                        A través de esta sección, podrá seleccionar cuales fueron, por ejemplo, los vuelos más vendidos de los últimos días, semanas, meses o años
                    </p>
                </div>
            </div>
            
            <form class='needs-validation' method='post' action='adminReporte.php'>
                <div class='form-row'>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-globe"></i>  Vuelos</label>
                        <select class='custom-select' name='vuelo'>
                            <option selected value='0'>Seleccione período (en días)</option>
                            <?php
                            $i = 1;
                            while($i <= 30){
                                echo "
                                    <option value='".$i."'> ".$i." </option>
                                     ";
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip02'><i class="fas fa-cocktail"></i>  Servicios</label>
                        <select class='custom-select' name='servicio'>
                            <option selected value='0'>Seleccione período (en días)</option>
                            <?php
                            $i = 1;
                            while($i <= 30){
                                echo "
                                    <option value='".$i."'> ".$i." </option>
                                     ";
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip03'><i class="fas fa-person-booth"></i>  Cabina</label>
                        <select class='custom-select' name='cabina'>
                            <option selected value='0'>Seleccione período (en días)</option>
                            <?php
                            $i = 1;
                            while($i <= 30){
                                echo "
                                    <option value='".$i."'> ".$i." </option>
                                     ";
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip04'><i class="fas fa-fighter-jet"></i>  Equipo</label>
                        <select class='custom-select' name='equipo'>
                            <option selected value='0'>Seleccione período (en días)</option>
                            <?php
                            $i = 1;
                            while($i <= 30){
                                echo "
                                    <option value='".$i."'> ".$i." </option>
                                     ";
                                $i++;
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-12 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscar'><i class='fas fa-search'></i>  Buscar</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </body>
</html>
