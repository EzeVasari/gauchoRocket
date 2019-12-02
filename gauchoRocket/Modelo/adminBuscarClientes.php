<?php
include('conexion.php');

if(isset($_POST["buscar"])){
    $cliente = $_POST["buscarCliente"];
        
    /* ======================================== */
    $query = "select u.active as estado, u.nombre as nombre, u.apellido as apellido,
                       u.email as user, c.verifMedica as medico, c.nivelVuelo as nivel, u.dni as dni
                  from cliente as c
	                   inner join usuario as u on c.fkEmailUsuario = u.email
                  where u.email like '%".$cliente."%'
                  order by c.fkEmailUsuario;";
    /* ======================================== */
        
    $resultado = mysqli_query($conexion, $query);
        
    if(mysqli_num_rows($resultado) >= 1) {
        include('../Vista/adminGenerarFacturaDos.php');
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                No se encontró ningún cliente con dicho e-mail.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </div>";
            
        $query = "select u.active as estado, u.nombre as nombre, u.apellido as apellido,
                                u.email as user, c.verifMedica as medico, c.nivelVuelo as nivel, u.dni as dni
                             from cliente as c
	                           inner join usuario as u on c.fkEmailUsuario = u.email;";            
        include('../Vista/adminGenerarFacturaDos.php');
        }
    }else{
        $query = "select u.active as estado, u.nombre as nombre, u.apellido as apellido,
                                u.email as user, c.verifMedica as medico, c.nivelVuelo as nivel, u.dni as dni
                             from cliente as c
	                           inner join usuario as u on c.fkEmailUsuario = u.email;";
        include('../Vista/adminGenerarFacturaDos.php');
        }
?>
