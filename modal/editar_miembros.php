 <div class="modal fade" id="EditMiembros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-edit'></i> Editar miembros</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
        	<form class="form-horizontal" method="post" id="editar_estudiante" name="editar_estudiante">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			   
			  <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">DNI</label>
				<div class="col-sm-12">
				  <input type="number" class="form-control" id="mod_cedula" name="mod_cedula" required="">
				</div>
			  </div>
        <div class="form-group">
        <label for="mod_email" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-12">
          <input type="email" class="form-control" id="mod_email" name="mod_email" required="">
        </div>
        </div>
<div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">Rol</label>
				<div class="col-sm-12">

        <select class="form-control" id="mod_rol" name="mod_rol" required>
                      <option value="0">--Seleccione un rol--</option>
                      <?php
                    $gf=mysqli_query($con,"select * from rol");
                    while ($rw=mysqli_fetch_array($gf)){
                      $idd=$rw["id"];
                      $grupo=$rw["rol"];
                      ?>
                      <option value="<?php echo $idd;?>"><?php echo $grupo;?></option>
                      <?php
                    }
                  ?>
        </select>

			<!-- 	<select class="form-control" name="mod_rol" id="mod_rol">
                      <option value="Colaborador" selected>Colaborador</option>
                      <option value="Supervisor">Supervisor</option>
        </select> -->


				</div>
			  </div>
			  <div class="input-group">
			  	<label for="mod_telefono" class="col-sm-3 control-label">Grupo</label>
			  	<div class="col-sm-12">
                      <select class="form-control" id="mod_grupo" name="mod_grupo" required>
                      <option value="0">--Seleccione un grupo--</option>
                      <?php
                    $gf=mysqli_query($con,"select * from grupos");
                    while ($rw=mysqli_fetch_array($gf)){
                      $idd=$rw["id"];
                      $grupo=$rw["nombre_grupo"];
                      ?>
                      <option value="<?php echo $idd;?>"><?php echo $grupo;?></option>
                      <?php
                    }
                  ?>
                    </select>
                </div>
                    <!-- /input-group -->
                  </div>
			  <div class="form-group">
				<label for="mod_estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-12">
					<select id="mod_estado" name="mod_estado" class="form-control">
					<option value="activo">Activo</option>
					<option value="inactivo">Inactivo</option>
					</select>
				</div>
			  </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>
