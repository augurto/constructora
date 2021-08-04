
<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
			if ($delete1=mysqli_query($con,"DELETE FROM estudiantes_proyecto WHERE id='".$idd."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		
		
	}
	if($action == 'ajax'){
		 $cod=$_GET['cod'];
		$sql="SELECT * FROM estudiantes_proyecto where codigo_proyecto='".$cod."'";
		$query = mysqli_query($con, $sql);
			?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>accion</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$estudiante=$row['estudiante'];
						 $grp=mysqli_query($con,'select * from miembros where id='.$estudiante.'');
                    $rw=mysqli_fetch_array($grp);

                      $nombre=$rw["nombre"];

						
					?>
					<tr>
						
						<td><?php echo $nombre; ?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-info' title='Eliminar miembro' onclick="eliminar(<?php echo $id;?>);" data-toggle="modal" data-target="#myModal2"><i class="fa fa-trash"></i></a> 
					</span></td>
					
					</tr>
					<?php
				}
				?>
			  	</tbody>
                </table>
              </div>
            

			<?php
		}
?>
  