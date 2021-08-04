
	 <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-cm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-file'></i> Editar grupo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_grupo" name="editar_grupo">
			<div id="resultados_ajax2"></div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-6 control-label">Nombre del grupo</label>
				<div class="col-sm-12">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_programa" class="col-sm-6 control-label">Nombre del programa</label>
				<div class="col-sm-12">
				 <select class="form-control" name="mod_programa"  id="mod_programa" required>
                      <option value="0">--Seleccione programa--</option>
                      <?php
										$grup=mysqli_query($con,"select * from programas");
										while ($rw=mysqli_fetch_array($grup)){
											$id=$rw["id"];
											$programa=$rw["programa"];
											?>
											<option value="<?php echo $id?>"><?php echo $programa?></option>
											<?php
										}
									?>
                    </select>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_telefono" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-12">
					<select name="mod_estado"  id="mod_estado"  class="form-control">
					<option value="activo" selected>Activo</option>
					<option value="inactivo">Inactivo</option>
					</select>
				</div>
			  </div>
		  </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		  </div>
    </div>
  </div>
</div>