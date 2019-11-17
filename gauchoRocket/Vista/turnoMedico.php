<!DOCTYPE html>
<html>
    <?php
    if(!isset($_SESSION)){
        session_start();
    }

    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');
    include("../Modelo/validarPaginasParaClientes.php");
    ?>
    
    <body>
        <br><br><div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-3">
                    <h2 class="font-weight-bold">Centros médicos</h2>
                    <p class="text-muted">Solicitá tu turno médico en cualquiera de nuestra amplias ubicaciones</p>
                </div>
            </div>
            <div class="row">
                <?php
                $query = "select c.codigo as codigo, c.turnos as turno, l.nombre as lugar, c.imagen as imagen
                        from centroMedico as c inner join lugar as l on c.codigoLugar = l.codigo;";
                $resultado = mysqli_query($conexion, $query);

                while ($centro = mysqli_fetch_assoc($resultado)){
                    $habilitar = "SI";
                    if($centro['turno'] <= 0){
                        $habilitar = "NO";
                    }
                    
                    echo"
                        <div class='col mb-4'>
                            <div class='card text-center mx-auto'>
                                <img src='".$centro['imagen']."' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$centro['lugar']."</h5>";
                                    
                                    
                                    if($habilitar == "SI"){
                                        echo "
                                            <p class='card-text'>Turnos disponibles: ".$centro['turno']."</p>
                                            <a href='#' class='btn btn-primary' data-toggle='modal' data-target='#validarMedico".$centro['codigo']."'>
                                                <i class='far fa-calendar-check'></i> Solicitar turno
                                            </a>
                                             ";
                                    }else{
                                        echo "
                                            <p>Sin turnos disponibles.</p>
                                             ";
                                    }
                                    
                                    
                                    
                                    echo"
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class='modal fade' id='validarMedico".$centro['codigo']."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-sm' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header text-center'>
                                        <h5 class='modal-title' id='exampleModalLabel'>
                                            ¿Está seguro que desea solicitar turno en el centro médico de<br>".$centro['lugar']."?
                                        </h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='../Modelo/validacionTurnoMedico.php' method='post'>
                                                <input type='hidden' name='codigoCentro' value='".$centro['codigo']."'>
                                            <div class='container'>
                                                <div class='row align-items-start'>
                                                    <button type='button' class='col btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                    <button type='submit' name='medico' class='col btn btn-primary'>Aceptar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                }
                ?>
            </div>
        </div>
    </body>
</html>
