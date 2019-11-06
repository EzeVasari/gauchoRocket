<!DOCTYPE html>
<html>
    <?php
    if(!isset($_SESSION)){
    session_start();
}

    include("../Modelo/conexion.php");
    include('head.php');
    include('navbar.php');

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
                $query = "select c.codigo as codigo, c.turnos as turno, l.nombre as lugar, c.imagen as imagen from centroMedico as c inner join lugar as l on c.codigoLugar = l.codigo;";
                $resultado = mysqli_query($conexion, $query);

                while ($centro = mysqli_fetch_assoc($resultado)){
                    echo"
                        <div class='col mb-4'>
                            <div class='card text-center mx-auto'>
                                <img src='".$centro['imagen']."' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$centro['lugar']."</h5>
                                    <p class='card-text'>Turnos: ".$centro['turno']."</p>
                                    <a href='../Modelo/validacionTurnoMedico.php?codigo=".$centro['codigo']."' class='btn btn-primary'><i class='far fa-calendar-check'></i> Solicitar turno</a>
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
