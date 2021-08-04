 <div class="modal fade" id="InsertarCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar evento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
           <form class="form-horizontal" id="guardar_evento" name="guardar_evento" method="POST">
            <div id="resultados_ajax"></div>
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-12">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo" required>
          </div>
          </div>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-12">
            <select name="color" class="form-control" id="color" required>
                    <option value="">Seleccionar</option>
              <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
              <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
              <option style="color:#008000;" value="#008000">&#9724; Verde</option>             
              <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
              <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
              <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
              <option style="color:#000;" value="#000">&#9724; Negro</option>
              
            </select>
          </div>
          </div>
          <div class="form-group">
          <label for="start" class="col-sm-4 control-label">Fecha Inicial</label>
          <div class="col-sm-12">
            <input type="text" name="start" class="form-control" id="start" readonly>
          </div>
          </div>
          <div class="form-group">
          <label for="end" class="col-sm-4 control-label">Fecha Final</label>
          <div class="col-sm-12">
            <input type="text" name="end" class="form-control" id="end" required>
          </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button> 
          <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
        </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>