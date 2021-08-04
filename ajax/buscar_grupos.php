
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
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_grupo');//Columnas de busqueda
		 $sTable = "grupos";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id desc ";
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
              <h6 class="m-0 font-weight-bold text-primary">Grupos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                  <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre del grupo</th>
                    <th>Nombre del programa</th>
                    <th>Fecha de creacion</th>
					  <?php if($_SESSION['prol']=='administrador'){?><th>Acciones</th><?php } ?>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$nombre=$row['nombre_grupo'];
						$estado=$row['estado'];
						$fecha=$row['fecha_agregado'];
						$programa=$row['nombre_programa'];
						$grup=mysqli_query($con,"select * from programas where id='$programa'");
										$rw=mysqli_fetch_array($grup);
											$programas=$rw["programa"];
					?>
					
					
					<tr><input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $programa;?>" id="programa<?php echo $id;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
						<td><?php echo $count++; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><?php echo $programas; ?></td>
						<td ><?php echo $fecha; ?></td>
					  <?php if($_SESSION['prol']=='administrador'){?>
					  	<td ><span class="pull-right">
					<a href="#" class='btn btn-success' title='Editar grupo' onclick="obtener_datos(<?php echo $id;?>);" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></a>
					<a href="#" class='btn btn-success' title='Eliminar grupo' onclick="eliminar('<?php echo $id;?>');"><i class="fa fa-trash"></i></a>
					</span></td>
				<?php } ?>
						
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


















