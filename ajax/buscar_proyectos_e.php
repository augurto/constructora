      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
       

<?php
session_start();
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
			if ($delete1=mysqli_query($con,"DELETE FROM proyecto WHERE codigo='".$idd."'")){
				$delete2=mysqli_query($con,"DELETE FROM cronograma WHERE codigo_proyecto='".$idd."'");
				$delete3=mysqli_query($con,"DELETE FROM programa_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete4=mysqli_query($con,"DELETE FROM investigadores_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete5=mysqli_query($con,"DELETE FROM estudiantes_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete6=mysqli_query($con,"DELETE FROM grupo_proyecto WHERE codigo_proyecto='".$idd."'");
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
		// escaping, additionally removing everything that could be (html/javascript-) code
			$username=$_SESSION["username"];
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
          $idc = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idc'], ENT_QUOTES)));
		 $aColumns = array('codigo_proyecto');//Columnas de busqueda
		 $sTable = "usuarios";
		 $sWhere = "Where username='".$username."'";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './miembros.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
	
		if ($numrows>0){
			
			?>
			<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                  <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre del proyecto</th>
					<th>Seguimientos</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$ids=$row['id'];
						$codigo=$row['codigo_proyecto'];
						

							$ge=mysqli_query($con,"SELECT * FROM proyecto WHERE codigo='".$codigo."'");
                   			$rows=mysqli_fetch_array($ge);

							$id=$rows['id'];
						$nombre=$rows['nombre_proyecto'];
						 $codigo=$rows['codigo'];
						$estado=$rows['estado'];
						$fecha=$rows['fecha_agregado'];
						$presupuesto=$rows['presupuesto'];
							$g=mysqli_query($con,"SELECT count(*) as total, id FROM entregables WHERE codigo_proyecto='".$codigo."'");
                   		$rw=mysqli_fetch_array($g);
                   		$total=$rw["total"];
                   		 $id_en=$rw["id"];


                   		 $s=mysqli_query($con,"SELECT * FROM miembros WHERE email='".$username."'");
                   		$rwse=mysqli_fetch_array($s);
                   		 $id_username=$rwse["id"];

							$s=mysqli_query($con,"SELECT count(*) as total_seg FROM seguimientos WHERE codigo_proyecto='".$codigo."'  AND id_miembros='".$id_username."'");
                   		$rwser=mysqli_fetch_array($s);
                   		 $total_s=$rwser["total_seg"];
          				
          				if($total_s!=0){
          					$r=100/$total;
          					$rst=$r*$total_s;
          				}else{
          					$r=0;
          					$rst=$r*$total;
          				}
          				
					
					?>
					
				
						<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo;?>" id="codigo<?php echo $id;?>">
						<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo;?>" id="cod<?php echo $id;?>">
					<input type="hidden" value="<?php echo $presupuesto;?>" id="presupuesto<?php echo $id;?>">
					<td><?php echo $count++; ?></td>
						<td><a href="info_proyecto.php?cod=<?php echo $codigo; ?>"><?php echo $nombre; ?></a></td>
						<td>

						<a href="subir_entregables.php?id_p=<?php echo $codigo;?>&id_est=<?php echo $id_username;?>" class="btn btn-info btn-icon-split" title='Subir entregables'>
                    <span class="icon text-white-50">
                      <i class="fas fa-file"></i>
                    </span>
                    <span class="text">Entregables</span>
                  </a>
				   <a href="ver_entregables.php?id_p=<?php echo $codigo;?>&id_est=<?php echo $id_username;?>$otro=<?php echo $est;?>" class="btn btn-info btn-icon-split" title='Ver entregables'>
                    <span class="icon text-white-50">
                      <i class="fas fa-file"></i>
                    </span>
                    <span class="text">Ver entregables</span>
                  </a>
					<p></p>
  <h4 class="small font-weight-bold">Estado<span class="float-right"><?php if($rst>=100){?>Completado!<?php }else{ echo number_format($rst).'%'; } ?></span></h4>
  <div class="progress">
  <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width:<?php echo $rst;?>%" aria-valuenow="<?php echo $rst;?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($rst);?>%</div>
</div>
				</td>
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
	}
?>

    <script src="vendor/jquery/jquery.min.js"></script>
 
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>








