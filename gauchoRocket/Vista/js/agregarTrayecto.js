$(document).ready(function(){
        var maxField = 6; // Numero maximo de campos
        
        var addButton = $('#btn-nuevoTrayecto'); // Selector del boton de Insertar
        
        var wrapper = $('#contenedor1'); // Contenedor de campos
        
    
        


       

        


        var fieldHTML = "<div class='col-sm-7' id='contenedor1'><label class='col-form-label'>trayecto</label><select class='custom-select' name='trayecto'>"

        
        var datos="<option selected value='0'>Seleccione trayecto</option><?php";
        var consulta="$consulta='SELECT  idTrayecto as codigo, nombreTrayecto as nombre FROM  trayecto '; $resultado = mysqli_query($conexion, $consulta); while($recorrer = mysqli_fetch_assoc($resultado)){ echo ' <option value=''. $recorrer['codigo'] .''>'. $recorrer['nombre'] .'</option>'; } ?></select></div>"; //Nuevos inputs ;
        var x = 0; // Iniciamos el contador a 2
        
        $(addButton).click(function(){ // Una vez que se haga click en el boton
            if(x <= maxField){ //Comprobamos el maximo
                x++; //Incrementar
                $(wrapper).append(fieldHTML+datos+consulta)

            }
        });
        
        $(wrapper).on('click', '#btn-borrar', function(e){ // Una vez se ha hecho click en el boton de eliminar
            e.preventDefault();
            $(this).parent('div').remove(); //Eliminamos el div
            x--; // Reducimos el contador en 1
        });
    });