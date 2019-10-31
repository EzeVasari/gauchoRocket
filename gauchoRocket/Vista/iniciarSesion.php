<div class="modal fade" id="iniciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Contraseña" required>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="iniciar" class="btn btn-primary">Iniciar sesion</button>
        </div>
     </form>
            <p class="text-center"><a href="#" class="text-primary" data-toggle="modal" data-target="#registrar" data-dismiss="modal">Crear usuario</a></p>
    </div>
   </div>
  </div>
</div>
