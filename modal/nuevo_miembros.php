<div class="modal fade" id="NuevoMiembro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-user'></i> Nuevo miembro</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
        <form class="form-horizontal" method="post" id="guardar_miembros" name="guardar_miembros">
      <div id="resultados_ajax"></div>
        <label>Nombre</label>
        <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    <span class="input-group-text"><sapn class="fa fa-user"></sapn></span>
                  </div>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre" required="">
                </div>

                <label>Email</label>
                <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="email" class="form-control" id="email_m" name="email" placeholder="Email" required="">
                </div>
         
                <label>DNI</label>
        <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    <span class="input-group-text">#</span>
                  </div>
                  <input type="number" class="form-control" name="cedula" placeholder="DNI" required="">
                </div> 
                  <label>Rol</label>
                <div class="form-group">
                    <select class="form-control" name="rol">
                      <option value="Colaborador">Colaborador</option>
                      <option value="Supervisor">Supervisor</option>
                    </select>
                  </div>
                   <label>Grupo</label>
                    <div class="input-group">
                      <select class="form-control" id="grupo" name="grupo" required>
                      <option value="0">--Seleccione un grupo--</option>
                      <?php
                    $programas=mysqli_query($con,"select * from grupos");
                    while ($rw=mysqli_fetch_array($programas)){
                      $id=$rw["id"];
                      $grupo=$rw["nombre_grupo"];
                      $programa=$rw["nombre_programa"];
                      ?>
                      <option value="<?php echo $id;?>"><?php echo $grupo;?></option>
                      <?php
                    }
                  ?>
                    </select>
                    <!-- /input-group -->
                  </div>

                     <label>Estado</label>
                    <div class="input-group">
                      <select class="form-control" id="estado" name="estado" required>
                      <option value="0">--Seleccione estado--</option>
                      <option value="activo">Activo</option>
                      <option value="inactivo">Inactivo</option>
                    </select>
                    <!-- /input-group -->
                  </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
