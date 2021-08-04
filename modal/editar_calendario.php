 <!-- Logout Modal-->
  <div class="modal fade" id="editCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar Evento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
           <form class="form-horizontal" id="guardar_evento1" name="guardar_evento1" method="POST">
          <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Titulo</label>
          <div class="col-sm-12">
            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
          </div>
          </div>
          <div class="form-group">
          <label for="color" class="col-sm-2 control-label">Color</label>
          <div class="col-sm-12">
            <select name="color" class="form-control" id="color">
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
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
              <label class="text-danger"><input type="checkbox"  name="delete"> Eliminar Evento</label>
              </div>
            </div>
          </div>
          
          <input type="hidden" name="id" class="form-control" id="id">
        
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-primary"  id="guardar_datos1">Guardar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  </div>