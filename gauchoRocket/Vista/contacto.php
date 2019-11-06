<?php
    include('head.php');
    include('navbar.php');
    include('../Modelo/iniciarSesion.php');
    include('iniciarSesion.php');
    include('../Modelo/registroUsuarios.php');
    include('registroUsuarios.php');
    
    
    echo'
    <div class="container">
    <br>
    <br>
    <br>
    <h1 class="display-3 text-center">Sucursales</h1>
    <br>
    <br>    
        <div class="row">
            <div class="col-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.014440002424!2d-58.38437648459182!3d-34.603796365009615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacf425a4a19%3A0xaf19ab7297421a8!2sAv.%209%20de%20Julio%20%26%20Av.%20Corrientes%2C%20C1048%20CABA!5e0!3m2!1ses!2sar!4v1572995956837!5m2!1ses!2sar" width="300" height="225" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          
                <h5 class="mt-0">Sucursal Buenos Aires</h5>
                    Av. Santa Fé 3253, Local 2041 Nivel 2 
                    Lunes a domingos de 10 a 22hs 
                    Tel 1236-12311 Interno 5274.
            
            </div> 
            
            <div class="col-1"></div>
            
            <div class="col-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.014440002424!2d-58.38437648459182!3d-34.603796365009615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacf425a4a19%3A0xaf19ab7297421a8!2sAv.%209%20de%20Julio%20%26%20Av.%20Corrientes%2C%20C1048%20CABA!5e0!3m2!1ses!2sar!4v1572995956837!5m2!1ses!2sar" width="300" height="225" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          
                <h5 class="mt-0">Sucursal Buenos Aires</h5>
                Av. Santa Fé 3253, Local 2041 Nivel 2 
                Lunes a domingos de 10 a 22hs 
                Tel 1236-12311 Interno 5274.            
            </div>         
        
        <div class="col-1"></div>
            
            <div class="col-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.014440002424!2d-58.38437648459182!3d-34.603796365009615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacf425a4a19%3A0xaf19ab7297421a8!2sAv.%209%20de%20Julio%20%26%20Av.%20Corrientes%2C%20C1048%20CABA!5e0!3m2!1ses!2sar!4v1572995956837!5m2!1ses!2sar" width="300" height="225" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          
                <h5 class="text-center">Sucursal Buenos Aires</h5>
                <p class="text-center">Av. Santa Fé 3253, Local 2041 Nivel 2 
                Lunes a domingos de 10 a 22hs 
                Tel 1236-12311 Interno 5274.</h1>            
            </div>
        
        </div>
        
        <h1 class="display-5 text-center">Consulta</h1>
        
         <form action="index.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="DNI" placeholder="DNI" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="E-mail" required>
          </div>
          <div class="form-group">
    <textarea class="form-control " id="validationTextarea" name="consulta" placeholder="consulta" required></textarea>
          </div>
        <div class="modal-footer">
            <button type="submit" name="botonConsulta" class="btn btn-primary">enviar consulta</button>
        </div>
    </form>
        
        
        
        
        </div>
    ';
    
    
?>
