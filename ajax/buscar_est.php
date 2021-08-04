<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
		$cod=$_GET['cod'];
		  $g=mysqli_query($con,"SELECT * FROM estudiantes_proyecto WHERE id='".$idd."'");
          $rw=mysqli_fetch_array($g);
          $estudiante=$rw["estudiante"];
          $gr=mysqli_query($con,"SELECT * FROM miembros WHERE id='".$idd."'");
          $rwr=mysqli_fetch_array($gr);
          $email=$rwr["email"];

			if ($delete1=mysqli_query($con,"DELETE FROM estudiantes_proyecto WHERE id='".$idd."'")){
				$delete2=mysqli_query($con,"DELETE FROM usuarios WHERE username='".$email."' AND codigo_proyecto='".$cod."'");
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
         $qq = mysqli_real_escape_string($con,(strip_tags($_REQUEST['qq'], ENT_QUOTES)));
          $ce = mysqli_real_escape_string($con,(strip_tags($_REQUEST['ce'], ENT_QUOTES)));
		 $aColumns = array('estudiante');//Columnas de busqueda
		 $sTable = "estudiantes_proyecto";
		 $sWhere = "WHERE codigo_proyecto=".$ce."";
		if ( $_GET['ce'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "codigo_proyecto='".$ce."' OR";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by estudiante";
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
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>#</th>
					<th>Nombre del Colaborador</th>
					<th></th>
					
					
				</tr>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$estudiante=$row['estudiante'];
						$es=mysqli_query($con,"SELECT * FROM miembros WHERE id='".$estudiante."'");
                   		$rws=mysqli_fetch_array($es);
                   		$estudiante=$rws["nombre"];
						
					?>
				
					<tr>
						
						<td><?php echo $count++; ?></td>
						<td><?php echo $estudiante; ?></td>
						<td><button type="button" class="btn btn-success"  onclick="eliminar_est(<?php echo $id; ?>, <?php echo $ce; ?>);">
             <span class="fa fa-trash"></span>
            </button></td>
						
					</tr>
					<?php
					
				}
				?>
				
			  </table>
			</div>
			<?php
		}
	}
?>