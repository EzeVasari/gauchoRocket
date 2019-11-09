<?php
 session_start();

    include("../Modelo/conexion.php");
    
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');

	$codigo = $_GET["reserva"];





	echo'
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container-fluid">
  		<form action="../Modelo/validarTargeta.php" method="get">
  </div>
  <div class="form-group" class="col-3">
    <label for="targeta">Ingrese su numero de tarjeta</label>
    <input type="text" name="targeta" class="form-control" id="formGroupExampleInput" placeholder="Example input">
  </div>
  <br>
  <br>
  <div class="form-group">
    <label for="codigo de seguridad">Codigo de Seguridad</label>
    <input type="text" name="codigoSeg" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
  </div>
   <div class="col-md-3 mb-3">
                        <label class="font-weight-bold" for="validationTooltip05"><i class="far fa-calendar-alt"></i>  Fecha de Vencimiento</label>
                        <div class="input-group date">
                            <input type="text" autocomplete="off" id="fecha" class="form-control" name="fecha" placeholder="DD/MM/AAAA">
                        </div>
                    </div>
    <select class="custom-select">
  <option selected>coutas</option>
  <option value="1">una</option>
  <option value="2">tres</option>
  <option value="3">seis</option>
</select>


 <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="confirmarPago" value='.$codigo = $_GET["reserva"].'"  class="btn btn-primary">confirmar</button>
        </div>
  </form>
  </div>';
    

?>