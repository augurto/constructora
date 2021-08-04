    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?php
session_start();

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
			if ($delete1=mysqli_query($con,"DELETE FROM grupos WHERE id='".$idd."'")){
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
		$username=$_SESSION["username"];
		 $s=mysqli_query($con,"SELECT * FROM miembros WHERE email='".$username."'");
          $rwse=mysqli_fetch_array($s);
            $id_username=$rwse["id"];

		  $ce = mysqli_real_escape_string($con,(strip_tags($_REQUEST['ce'], ENT_QUOTES)));
		$sql="SELECT * FROM  seguimientos WHERE codigo_proyecto='".$ce."' AND id_miembros='".$id_username."'";
		$query = mysqli_query($con, $sql);
			?>

				<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Entregables</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Entregable</th>
                      <th>Documento</th>
                       </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$id_seg=$row['id_seg'];
						$documento=$row['documento'];
						$descripcion=$row['descripcion'];

					$g=mysqli_query($con,"SELECT * FROM entregables WHERE id='".$id_seg."'");
                   $rw=mysqli_fetch_array($g);
                    $nombre=$rw["nombre"];
						
						
					?>
				
					<tr>
						
						<td><?php echo $count++; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><a href="entregables/<?php echo $documento; ?>" download="entregables/<?php echo $documento; ?>">Descargar</a></td>
					
					</tr>
					<?php
					
				}
				?>
					</tbody>
                </table>
              </div>
            </div>
          </div>

			<?php
		
	}
?>
  <script src="vendor/jquery/jquery.min.js"></script>
 
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

