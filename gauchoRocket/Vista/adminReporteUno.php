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
        <div class='container buscador p-2 mb-2 mt-5 border border-info'>
            
            <div class="row justify-content-center">
                <div class="col-md-9 text-center mb-3">
                    <h2 class="font-weight-bold">Bienvenido al área de reportes</h2>
                    <p class="text-muted">
                        A través de esta sección, podrá informarse sobre el estado de los vuelos, cabinas, servicios y equipos que usted desee.
                    </p>
                </div>
            </div>
            
            <form class='needs-validation' method='post' action='adminReporte.php'>
                <div class='form-row'>
                    
                    <div class='col-md-12 mb-3'>
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
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
                    
                    <div class='col-md-12 mb-3'>
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
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
                    
                    <div class='col-md-12 mb-3'>
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
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
                    
                    <div class='col-md-12 mb-3'>
                        <label class='font-weight-bold' for='validationTooltip04'><i class="fas fa-fighter-jet"></i>  Equipo</label>
                        <select class='custom-select' name='equipo'>
                            <option selected value='0'>Seleccione equipo</option>
                            <?php
                            $query = "select codigo, descripcion from tipoDeEquipo;";
                            $resultado = mysqli_query($conexion, $query);
                            
                            while($row = mysqli_fetch_assoc($resultado)){
                                echo "
                                    <option value='".$row['codigo']."'> ".$row['descripcion']." </option>
                                     ";
                            }
                            ?>
                        </select>
                    </div>
                    
<!--=============--><div class='col-md-12 mb-5'></div><!--==============================================================================-->
                    
                    <div class='col-md-12 mt-3'>
                        <button class='btn btn-primary w-100' type='submit' name='buscar'><i class="fas fa-flag"></i>  Generar reporte</button>
                    </div>
                    
                </div>
            </form>
        </div>
        <?php
        include('../Modelo/adminValidarReporte.php');
        ?>
    </body>
</html>
