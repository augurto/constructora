  <div class="modal fade" id="NuevoProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class='fa fa-file'></i> Nuevo proyecto</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div> 
        <div class="modal-body">
        <form class="form-horizontal" method="post" id="guardar_proyecto" name="guardar_proyecto">
      <div id="resultados_ajax"></div>
        <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         <span class="fa fa-user"></span>
                        </span>
                      </div>
                      <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre del proyecto" required>
                    </div>
                    <!-- /input-group -->
                  </div>
                 <p></p>
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><span class="fa fa-qrcode"></span></span>
                      </div>
                      <input type="number" class="form-control" id="codigo"  name="codigo" onkeyup="loa();" placeholder="Codigo" required>
                    </div>
                    <!-- /input-group -->
                  </div>
                  <!-- /.col-lg-6 -->
                </div>
                <br>
                <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Descripcion del proyecto" name="descripcion"></textarea>
                  </div>
              </div>
          </div>
                <div class="row">
              <div class="col-lg-6" id="inv_g" style="display: none;" >
                <div class="form-group">
                
         <input type="hidden" class="form-control" name="c" id="c">  
          <div class="resultados2" id="resultados2"></div>  
<select id="browsers"  class="form-control select3"  name="investigador" style="width: 100%;">
   <?php
                    $inv=mysqli_query($con,"select * from miembros where rol='Supervisor'");
                    while ($rw=mysqli_fetch_array($inv)){
                      $id=$rw["id"];
                      $nombre=$rw["nombre"].' '.$rw["apellidos"];
                      ?>
                      <option value="<?php echo $id;?>"><?php echo $nombre?></option>
                      <?php
                    }
                  ?></select>
                  <p></p>
                  <div class="form-group">
                  <select name="rol" id="rol">
                      <option value="Jefe Proyecto" id="in">Jefe del Proyecto</option>
                    <option value="Supervisor" id="co">Supervisor</option>
                  </select>
               
                 </div>
                 <button type="button" class="btn btn-success btn-sm" id="a_inv">Guardar</button>
                  </div>
              </div>
              <div class="col-lg-6" id="est_g" style="display: none;">
                <div class="resultados3" id="resultados3"></div>
                <div class="form-group">
                   
         <input type="hidden" class="form-control" name="ce" id="ce">  
                  <select class="form-control select2" id="estudiante" name="estudiante" style="width: 100%;">
                    <?php
                    $inv=mysqli_query($con,"select * from miembros where rol='Colaborador'");
                    while ($rw=mysqli_fetch_array($inv)){
                      $id=$rw["id"];
                      $nombre=$rw["nombre"];
                      ?>
                      <option value="<?php echo $id;?>"><?php echo $nombre?></option>
                      <?php
                    }
                  ?>
                  </select>
                  <p></p>
                    <button type="button" class="btn btn-primary btn-sm" id="a_est">Guardar</button>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-6">
                <div id="" class="outer_div2">
                  </div>
              </div>
              <div class="col-lg-6">
                <div  id="" class="outer_div3">
                    
                  </div>
              </div>
          </div>
          <div class="form-group">
                    <input type="number" class="form-control" name="presupuesto"  placeholder="Presupuesto" required>
                  </div>
                  <label>Cronograma</label>
                 <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><span class="fas fa-calendar"></span></span>
                      </div>
                      <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" title="Fecha inicio" required>
                    </div>
                    <!-- /input-group -->
                  </div>
                  <br>
                  <!-- /.col-lg-6 -->
                  <div class="col-lg-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><span class="fas fa-calendar"></span></span>
                      </div>
                      <input type="date" class="form-control" name="fecha_fin"  id="fecha_fin"  title="Fecha fin" required>
                    </div>
                    <!-- /input-group -->
                  </div>
<br>
                  <!-- /.col-lg-6 -->
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <select class="form-control" id="grupos" name="grupos" required>
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
                    </div>
                    <!-- /input-group -->
                  </div>
                  
                  <div class="col-lg-6">
                    <div class="input-group">
                      <select class="form-control" disabled name="programa" id="pr" required >
                      <option value="0"></option>
                      <?php
                    $progr=mysqli_query($con,"select * from programas");
                    while ($rws=mysqli_fetch_array($progr)){
                      $idd=$rws["id"];
                      $program=$rws["programa"];
                      ?>
                      <option value="<?php echo $rws["id"];?>"><?php echo $rws["programa"];?></option>
                      <?php
                    }
                  ?>
                    </select>
                    </div>
                    <!-- /input-group -->
                  </div>
                  <!-- /.col-lg-6 -->
                  
               
                 
                </div>
               
<div class="container">
  <p></p>
      <a class="btn btn-primary" href="javascript:void(0)" id="addInput">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        Mas entregables
      </a>
      <br>
     <label>Entregables</label>
      <div id="dynamicDiv">
            <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text">
                <span class="fa fa-file">
                </span>
              </span>
              </div><input type="text" class="form-control" name="entregable[]" onkeyup="loa();" placeholder="Nombre del entregable" required>
              </div>
              </div>
                <div class="col-lg-5"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><span class="fas fa-calendar"></span></span></div><input type="date" class="form-control"  name="f[]" onkeyup="loa();" placeholder="Codigo" required></div></div></div><p></p>
              </div>
       
      </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-info" id="guardar_datos">Guardar datos</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script>

$(document).ready(function() {
  $("#select2insidemodal").select2({
    dropdownParent: $("#myModal")
  });
});

</script>
  <script>
      $(function () {
          var scntDiv = $('#dynamicDiv');

          $(document).on('click', '#addInput', function () {
              $('<div class="row" id="divinput"><div class="col-lg-6"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><span class="fa fa-file"></span></span></div><input type="text" class="form-control" name="entregable[]"  onkeyup="loa();" placeholder="Nombre del entregable" required></div></div><div class="col-lg-5"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><span class="fas fa-calendar"></span></span></div><input type="date" class="form-control" id="codigo"  name="f[]" onkeyup="loa();" placeholder="Codigo" required><a class="btn btn-primary" class="col-lg-3" href="javascript:void(0)" id="remInput">'+
              '<span class="fas fa-trash" aria-hidden="true"></span> </a></div></div></div><p></p>'+
                ''+
                ''+
              ''+
          '').appendTo(scntDiv);
              return false;
          });

          $(document).on('click', '#remInput', function () {
                $(this).parents('#divinput').remove();
              return false;
          });
      });
      </script>

        