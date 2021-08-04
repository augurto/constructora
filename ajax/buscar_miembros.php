 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php
session_start();
	
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
			if ($delete1=mysqli_query($con,"DELETE FROM miembros WHERE id='".$idd."'")){
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
		$sql="SELECT * FROM  miembros";
		$query = mysqli_query($con, $sql);
			?>
			<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Miembros</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>Nombre</th>
					<th>DNI</th>
					<th>Email</th>
					<th>Rol</th>
					<th>Grupo</th>
					<th>Estado</th>
					 <?php if($_SESSION['prol']=='administrador'){?><th class='text-right'>Acciones</th><?php } ?>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$nombre=$row['nombre'];
						$cedula=$row['cedula'];
						$estado=$row['estado'];
						$email=$row['email'];
						$rol=$row['rol'];
						$grupo=$row['grupo'];
						if ($estado=='activo'){$label_class='warning '; $ico='info';}
						else{$text_estado="inactivo";$label_class='danger'; $ico='exclamation-triangle';}
					?>
					<tr>
						
						<td><?php echo $nombre; ?></td>
						<td ><?php echo $cedula; ?></td>
						<td ><?php echo $email; ?></td>
						<td ><?php echo $rol; ?></td>
						<?php $grp=mysqli_query($con,'select * from grupos where id='.$row['grupo'].'');
                    $rw=mysqli_fetch_array($grp);

                      $nombre_grupo=$rw["nombre_grupo"];
                      ?>
                     <td ><?php echo $nombre_grupo; ?></td>
                    
					  <td><a href="#" class="btn btn-<?php echo $label_class;?> btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-<?php echo $ico; ?>"></i>
                    </span>
                    <span class="text"><?php echo $estado; ?></span>
                  </a></td>
					 <?php if($_SESSION['prol']=='administrador'){?><td ><span class="pull-right">
					<a href="#" class='btn btn-info' title='Editar miembro' onclick="obtener_datos(<?php echo $id;?>);" data-toggle="modal" data-target="#EditMiembros"><i class="fa fa-edit"></i></a>
					<a href="#" class='btn btn-info' title='Eliminar miembro' onclick="eliminar(<?php echo $id;?>);" data-toggle="modal" data-target="#myModal2"><i class="fa fa-trash"></i></a> 
					</span></td>
				<?php } ?>
						<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $cedula;?>" id="cedula<?php echo $id;?>">
					<input type="hidden" value="<?php echo $rol;?>" id="rol<?php echo $id;?>">
					<input type="hidden" value="<?php echo $grupo;?>" id="grupo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
					<input type="hidden" value="<?php echo $nombre_grupo;?>" id="grupo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $email;?>" id="email<?php echo $id;?>">
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
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
 
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

   <?php 
        $activo=mysqli_query($con,"SELECT count(*) as activo FROM miembros where estado='activo'");
        $rwt_act=mysqli_fetch_array($activo);
        $act=$rwt_act['activo'];

        $inactivo=mysqli_query($con,"SELECT count(*) as inactivo FROM miembros where estado='inactivo'");
        $rwt_inac=mysqli_fetch_array($inactivo);
        $inac=$rwt_inac['inactivo'];
 ?>
  <script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Activos", "Inactivos"],
    datasets: [{
      data: [<?php echo $act; ?>, <?php echo $inac; ?>],
      backgroundColor: ['#6610f2', '#e74a3b'],
      hoverBackgroundColor: ['#6610f2', '#e74a3b'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

  </script>