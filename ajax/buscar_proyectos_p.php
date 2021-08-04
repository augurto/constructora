      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
       

<?php
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
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
          $c = mysqli_real_escape_string($con,(strip_tags($_REQUEST['c'], ENT_QUOTES)));
		 $aColumns = array('codigo_proyecto');//Columnas de busqueda
		 $sTable = "usuarios";
		 $sWhere = "Where username='".$c."' group by codigo_proyecto order by id desc";
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
					<th>codigo</th>
					<th>presupuesto</th>
					<th>Fecha agregado</th>
					<th>Rol</th>
					<th>Seguimientos</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$codigo=$row['codigo_proyecto'];
						
							$sql1="SELECT * FROM  proyecto where codigo='".$codigo."'";
							$query1 = mysqli_query($con, $sql1);
							$rows=mysqli_fetch_array($query1);

							$sql2="SELECT * FROM  miembros where email='".$c."'";
							$query2 = mysqli_query($con, $sql2);
							$row2=mysqli_fetch_array($query2);
							$id_es=$row2['id'];

							$id=$rows['id'];
						$nombre=$rows['nombre_proyecto'];
						$codigo=$rows['codigo'];
						$estado=$rows['estado'];
						$fecha=$rows['fecha_agregado'];
						$presupuesto=$rows['presupuesto'];
					
					?>
					
				
						<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo;?>" id="codigo<?php echo $id;?>">
						<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo;?>" id="cod<?php echo $id;?>">
					<input type="hidden" value="<?php echo $presupuesto;?>" id="presupuesto<?php echo $id;?>">
					<td><?php echo $count++; ?></td>
						<td><a href="info_proyecto.php?cod=<?php echo $codigo; ?>"><?php echo $nombre; ?></a></td>
						<td><?php echo $codigo; ?></td>
						<td>$ <?php echo number_format($presupuesto);?></td>
						<td ><?php echo $fecha; ?></td>
						<td><?php echo $row['rol']; ?></td>
						<td>
							<?php if($row['rol']=='Inv Principal'){?>
						<a href="entregables.php?id_p=<?php echo $codigo; ?>&id_est=<?php echo $id_es; ?>" class='btn btn-success' title='Ver entregables'>Entregables</a>
						<?php }else{?>
							<a href="entregables.php?id_p=<?php echo $codigo; ?>&id_est=<?php echo $id_es; ?>" class='btn btn-success' title='Ver entregables'>Entregables</a>
						<?php }?></td>
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








