    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?php
session_start();

	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
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
		$codigo=$_GET['id_p'];
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
                      <th>Colaborador</th>
                      <th>Acciones</th>
                       </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1; 
				$sql=mysqli_query($con,"SELECT * FROM usuarios WHERE codigo_proyecto='".$codigo."' AND rol='Colaborador'"); /* aca me muestra la lista de los entregables  */
				while ($row=mysqli_fetch_array($sql)){
						$username_p=$row['username'];
						
				$s=mysqli_query($con,"SELECT * FROM miembros WHERE email='".$username_p."'");
                   		$rws=mysqli_fetch_array($s);
                   		 $nom=$rws["nombre"];
                   		  $id_est=$rws["id"];

                   		  $se=mysqli_query($con,"SELECT count(*) as total_seg FROM seguimientos WHERE codigo_proyecto='".$codigo."' AND id_miembros='".$id_est."'");
                   		$rwse=mysqli_fetch_array($se);
                   		$total_se=$rwse["total_seg"];
					
						$g=mysqli_query($con,"SELECT count(*) as total, id FROM entregables WHERE codigo_proyecto='".$codigo."'");
                   		$rw=mysqli_fetch_array($g);
                   		$total=$rw["total"];
                   		 $id_en=$rw["id"];


                   		 $st=mysqli_query($con,"SELECT * FROM miembros WHERE email='".$username."'");
                   		$rwse=mysqli_fetch_array($st);
                   		 $id_username=$rwse["id"];

							$sc=mysqli_query($con,"SELECT count(*) as total_seg FROM seguimientos WHERE codigo_proyecto='".$codigo."'  AND id_miembros='".$id_est."'");
                   		$rwser=mysqli_fetch_array($sc);
                   		 $total_s=$rwser["total_seg"];
          				
          				if($total_s!=0){
          					$r=100/$total;
          					$rst=$r*$total_s;
          				}else{
          					$r=0;
          					$rst=$r*$total;
          				}
					?>
				
					<tr>
						
						<td><?php echo $count++; ?></td>
						<td><span style="text-transform: capitalize;"><?php echo $nom; ?></span></td>
						<td> <a href="ver_entregables.php?id_p=<?php echo $codigo; ?>&id_est=<?php echo $id_est; ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <?php echo $total_se;?>
                    </span>
                    <span class="text">Entregables</span>
                  </a>					<p></p>
  <h4 class="small font-weight-bold">Estado<span class="float-right"><?php if($rst>=100){?>Completado!<?php }else{ echo number_format($rst).'%'; } ?></span></h4>
  <div class="progress">
  <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:<?php echo $rst;?>%" aria-valuenow="<?php echo $rst;?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($rst);?>%</div>
</div></td>
					
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

