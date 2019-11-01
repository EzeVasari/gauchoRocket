$(document).ready(function(){
        var maxField = 5; // Numero maximo de campos
        
        var addButton = $('#btn-nuevaPersona'); // Selector del boton de Insertar
        
        var wrapper = $('#contenedor'); // Contenedor de campos
        
    
        
        var fieldHTML = '<hr><h5>Persona</h5><div class="row"><div class="form-group col-md-6"><label>Nombre</label><input type="text" class="form-control" name="nombres[]" required></div><div class="form-group col-md-6"><label>Apellido</label><input type="text" class="form-control" name="apellidos[]" required></div><div class="form-group col-md-6"><label>DNI</label><input type="text" class="form-control" name="documentos[]" required></div><div class="form-group col-md-6"><label>Nick</label><input type="text" class="form-control" name="nicks[]" required></div></div>'; //Nuevos inputs 
        
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