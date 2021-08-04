
		  	<div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-comments'></i><b> Comentar entregable</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
		   <form method="post"  id="subir_comentario" name="subir_comentario">
			<div id="resultados_ajax"></div>
			 <div class="form-group">
				<label for="user_password_new3" class="col-sm-12 control-label">Comentarios</label>
				 <div class="table-responsive" id="card_comentarios">
             </div>
			  </div>
			  <div class="col-lg-12">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
            <div>
            <!-- Messages-->
            
            <!-- Reply Form-->
            <h5 class="mb-30 padding-top-1x">Deja tu comentario</h5>
              <div class="form-group">
                <textarea class="form-control form-control-rounded" id="comentario" name="comentario" rows="3" placeholder="Escribe tu comentario..." required=""></textarea>
                <input class="form-control" type="hidden" value="<?php echo $_GET['id_p']; ?>" id="idd_proyecto"  name="idd_proyecto">
                  <input class="form-control" type="hidden" value="<?php echo $_GET['id_est']; ?>" id="id_est"  name="id_est">
                    <input class="form-control" type="hidden" value="" id="id_seg"  name="id_seg">
                    <input class="form-control" type="hidden" value="" id="ident"  name="id_ent">

              </div>
          </div>
        </div>
       
		  </div>
      
		  <div class="modal-footer">
     <!--  <button class="btn btn-outline-primary"  id="subir_video" type="submit">Subir video</button> -->
              
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

		
      
      <form action='subir_video_comentario.php?id_proyecto=<?php echo $_GET["id_p"];?>&rol=<?php echo $_GET["id_seg"];?>' method="post" enctype="multipart/form-data">
                    <input  class="btn btn-default" type="file" name="archivo">
                    <br><br>
                    <button class="btn btn-outline-primary"  id="guardar_datos" type="submit">Subir comentario</button>
                    <button  >Subir VIdeo</button>
        	    </form>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
</div>