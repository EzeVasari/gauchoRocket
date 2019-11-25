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
        <div class='container buscador p-2 mb-2 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-9 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de facturación</h2>
                    <p class="text-muted">
                        A través de esta sección, podrá seleccionar cuales fueron, por ejemplo, los vuelos más vendidos de los últimos días, semanas, meses o años
                    </p>
                </div>
            </div>
            
            <form class='needs-validation' method='post' action='../Modelo/validacionFacturacion.php'>
                <div class='form-row'>
                    
                    <div class='col-md-12'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-money-check-alt"></i>  Total facturado</label>
                    </div>

                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="far fa-calendar-alt"></i>  Período</label>
                        <select class='custom-select' name='totalPeriodo'>
                            <option selected value='0'>Seleccione período</option>
                            <option value='1'>Días</option>
                            <option value='2'>Semanas</option>
                            <option value='3'>Meses</option>
                            <option value='4'>Años</option>
                        </select>
                    </div>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-calendar-alt"></i>  Antigüedad</label>
                        <input class='custom-select' type="number" name="totalAntiguedad">
                    </div>
                    
                </div>
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
            
                <div class='form-row'>
                    
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-globe"></i>  Vuelos</label>
                        <select class='custom-select' name='vuelo'>
                            <option selected value='0'>Seleccione vuelo</option>
                            <?php
                            $query = "select codigo, nombre from viaje;";
                            $resultado = mysqli_query($conexion, $query);
                            
                            while($row = mysqli_fetch_assoc($resultado)){
                                echo "
                                    <option value='".$row['codigo']."'> ".$row['nombre']." </option>
                                     ";
                            }
                            ?>
                        </select>
                    </div>

                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="far fa-calendar-alt"></i>  Período</label>
                        <select class='custom-select' name='vueloPeriodo'>
                            <option selected value='0'>Seleccione período</option>
                            <option value='1'>Días</option>
                            <option value='2'>Semanas</option>
                            <option value='3'>Meses</option>
                            <option value='4'>Años</option>
                        </select>
                    </div>
                    
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-calendar-alt"></i>  Antigüedad</label>
                        <input class='custom-select' type="number" name="vueloAntiguedad">
                    </div>
                    
                </div>
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
            
                 <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip02'><i class="fas fa-cocktail"></i>  Servicios</label>
                        <select class='custom-select' name='servicio'>
                            <option selected value='0'>Seleccione servicio</option>
                            <?php
                            $query = "select codigoTipoDeServicio, descripcion from tipoDeServicio;";
                            $resultado = mysqli_query($conexion, $query);
                            
                            while($row = mysqli_fetch_assoc($resultado)){
                                echo "
                                    <option value='".$row['codigoTipoDeServicio']."'> ".$row['descripcion']." </option>
                                     ";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="far fa-calendar-alt"></i>  Período</label>
                        <select class='custom-select' name='servicioPeriodo'>
                            <option selected value='0'>Seleccione período</option>
                            <option value='1'>Días</option>
                            <option value='2'>Semanas</option>
                            <option value='3'>Meses</option>
                            <option value='4'>Años</option>
                        </select>
                    </div>
                    
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-calendar-alt"></i>  Antigüedad</label>
                        <input class='custom-select' type="number" name="servicioAntiguedad">
                    </div>
                     
                </div>
            
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
            
                 <div class='form-row'>
                    <div class='col-md-6 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip03'><i class="fas fa-person-booth"></i>  Cabina</label>
                        <select class='custom-select' name='cabina'>
                            <option selected value='0'>Seleccione cabina</option>
                            <?php
                            $query = "select codigoTipoDeCabina, descripcion from tipoDeCabina;";
                            $resultado = mysqli_query($conexion, $query);
                            
                            while($row = mysqli_fetch_assoc($resultado)){
                                echo "
                                    <option value='".$row['codigoTipoDeCabina']."'> ".$row['descripcion']." </option>
                                     ";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="far fa-calendar-alt"></i>  Período</label>
                        <select class='custom-select' name='cabinaPeriodo'>
                            <option selected value='0'>Seleccione período</option>
                            <option value='1'>Días</option>
                            <option value='2'>Semanas</option>
                            <option value='3'>Meses</option>
                            <option value='4'>Años</option>
                        </select>
                    </div>
                    
                    <div class='col-md-3 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip01'><i class="fas fa-calendar-alt"></i>  Antigüedad</label>
                        <input class='custom-select' type="number" name="cabinaAntiguedad">
                    </div>
                     
                     <div class='col-md-12 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscarCabina'><i class='fas fa-search'></i>  Buscar</button>
                    </div>
                </div>
            </form>
        </div>
           
       
    </body>
</html>
