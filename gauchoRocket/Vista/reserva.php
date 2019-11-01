<?php include("../Modelo/validacionReserva.php");?>
<!DOCTYPE html>
<html>
    <body>
       
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 5; // Numero maximo de campos
        
        var addButton = $('#btn-nuevaPersona'); // Selector del boton de Insertar
        
        var wrapper = $('#contenedor'); // Contenedor de campos
        
    
        
        var fieldHTML = '<h5>Persona</h5><div class="row"><div class="form-group col-md-6"><label>Nombre</label><input type="text" class="form-control" name="nombres[]" required></div><div class="form-group col-md-6"><label>Apellido</label><input type="text" class="form-control" name="apellidos[]" required></div><div class="form-group col-md-6"><label>DNI</label><input type="text" class="form-control" name="documentos[]" required></div><div class="form-group col-md-6"><label>Nick</label><input type="text" class="form-control" name="nicks[]" required></div></div>'; //Nuevos inputs 
        
        var x = 2; // Iniciamos el contador a 2
        
        $(addButton).click(function(){ // Una vez que se haga click en el boton
            if(x <= maxField){ //Comprobamos el maximo
                x++; //Incrementar
                $(wrapper).append(fieldHTML); // Añadimos el HTML
            }
        });
        
        $(wrapper).on('click', '.remove_button', function(e){ // Una vez se ha hecho click en el boton de eliminar
            e.preventDefault();
            $(this).parent('div').remove(); //Eliminamos el div
            x--; // Reducimos el contador en 1
        });
    });
           
</script>
       
        <div class="container" style="margin-top: 5rem;">
           <h3 class="font-weight-bold" >Reserva</h3>
            <div class="row justify-content-between" id="tabla">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg" >
                    <h4 class="font-weight-bold">¿Quienes viajan?</h4>
                    <p class="text-muted">El titular será responsable de hacer el check-in</p>
                    <h5>Persona 1</h5> <div class="btn btn-primary" id="btn-nuevaPersona">Agregar persona</div>
                    <form id="contenedor" action="reserva.php?codigo=<?php echo $codigo ?>" method="post">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Nombre</label>
                          <input type="text" class="form-control" value="<?php echo $datos["nombre"];?>" name="nombres[]" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Apellido</label>
                          <input type="text" class="form-control" value="<?php echo $datos["apellido"];?>" name="apellidos[]" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label>DNI</label>
                        <input type="text" class="form-control" value="<?php echo $datos["dni"];?>" name="documentos[]" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Nick</label>
                        <input type="text" class="form-control" value="<?php echo $datos["nick"];?>" name="nicks[]"readonly>
                      </div>
                      </div>
                   </div>
                   
                   <div class="col-md-4 bg-light p-3 border border-primary rounded-lg">
                       <h4 class="font-weight-bold">Info de vuelo</h4>
                          <div class=''>
                            <h5 class='card-title'><?php echo $viaje['nombre'];?></h5>
                            <p class='card-text'><?php echo $viaje['descripcion'];?></p>
                            <h5 class='text-center'>Desde: U$ <?php echo $viaje['precio'];?></h5>
                          </div>
                   </div>
                </div>
            <div class="row mt-2">
                <div class="col-md-7 bg-light p-3 border border-primary rounded-lg">
                    <h4 class="font-weight-bold">Ubicación y Servicio</h4>
                    <p class="text-muted">Elija tipo de cabina y de servicio</p>
                   
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class='font-weight-bold'>Cabina</label>
                          <select class='custom-select' name='cabina'>
                            <option selected value="General">General</option>
                            <option value="Familiar">Familiar</option>
                            <option value="Suite">Suite</option>
                        </select>
                    </div>
                        <div class="form-group col-md-6">
                          <label class='font-weight-bold'>Servicio</label>
                          <select class='custom-select' name='servicio'>
                            <option selected value="Standard">Standard</option>
                            <option value="Gourmet">Gourmet</option>
                            <option value="Spa">Spa</option>
                        </select>
                        </div>
                        </div>
                     </div>
                      <div class="col-md-7 mt-2 mb-3">
                       <button class='btn btn-primary w-100 text-white' type='submit' name='confirmarReserva'>Confirmar reserva</button>
                       </div>
                    </form>
            </div>
                
            </div>
    </body>
</html>
