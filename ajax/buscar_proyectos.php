       <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <?php 
  require_once ("../config/db.php");
  require_once ("../config/conexion.php");
        $sald=mysqli_query($con,"SELECT Sum(presupuesto) as saldo FROM proyecto where estado='terminado'");
        $rwt=mysqli_fetch_array($sald);
        $saldo=$rwt['saldo'];

  ?>

    
    <?php
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=$_GET['id'];
			if ($delete1=mysqli_query($con,"DELETE FROM proyecto WHERE codigo='".$idd."'")){
				$delete2=mysqli_query($con,"DELETE FROM cronograma WHERE codigo_proyecto='".$idd."'");
				$delete3=mysqli_query($con,"DELETE FROM programa_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete4=mysqli_query($con,"DELETE FROM investigadores_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete5=mysqli_query($con,"DELETE FROM estudiantes_proyecto WHERE codigo_proyecto='".$idd."'");
				$delete6=mysqli_query($con,"DELETE FROM grupo_proyecto WHERE codigo_proyecto='".$idd."'");
        $delete7=mysqli_query($con,"DELETE FROM usuarios WHERE codigo_proyecto='".$idd."'");
        $delete8=mysqli_query($con,"DELETE FROM comments WHERE codigo_proyecto='".$idd."'");
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
     $tp=mysqli_query($con,"SELECT count(*) as tp FROM proyecto");
      $rwp=mysqli_fetch_array($tp);
      $tps=$rwp["tp"];

      $te=mysqli_query($con,"SELECT count(*) te FROM miembros where rol='Colaborador'");
      $rwe=mysqli_fetch_array($te);
      $tes=$rwe["te"];

      $ti=mysqli_query($con,"SELECT count(*) ti FROM miembros where rol='Supervisor'");
      $rwi=mysqli_fetch_array($ti);
      $tin=$rwi["ti"];

		$sql="SELECT * FROM  proyecto order by id desc";
		$query = mysqli_query($con, $sql);         
			?>
      <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">S/<?php echo number_format($saldo,2);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign  fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de proyectos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tps;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Colaborador</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $tes;?></div>
                        </div>
                        <div class="col">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Supervisor</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tin;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
			<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Proyectos</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    	<th>ID</th>
                      <th>Proyecto</th>
                      <th>Codigo</th>
                      <th>Presupuesto</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                      <th>Entregables</th>
                    </tr>
                  </thead>
                  <tbody>
				<?php
				$count=1;
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$nombre=$row['nombre_proyecto'];
						$codigo_=$row['codigo'];
						$estado=$row['estado'];
						$fecha=$row['fecha_agregado'];
            $descripcion=$row['descripcion'];
						$presupuesto=$row['presupuesto'];
						if ($estado=='terminado'){$label_class='primary'; $ico='check';}
						else if ($estado=='activo'){$label_class='warning '; $ico='info';}
						else{$text_estado="inactivo";$label_class='danger'; $ico='exclamation-triangle';}

						$g=mysqli_query($con,"SELECT count(*) as total FROM entregables WHERE codigo_proyecto='".$codigo_."'");
            $rw=mysqli_fetch_array($g);
            $total=$rw["total"];

                   		$s=mysqli_query($con,"SELECT count(*) as total_seg FROM seguimientos WHERE codigo_proyecto='".$codigo_."'");
                   		$rws=mysqli_fetch_array($s);
                   		$total_s=$rws["total_seg"];
          				
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
                      <td><a href="info_proyecto.php?cod=<?php echo $codigo_; ?>"><?php echo $nombre; ?></a></td>
                      <td width="4%"><?php echo $codigo_; ?></td>
                      <td width="5%">S/ <?php echo number_format($presupuesto); ?></td>
                      <td><?php echo $fecha; ?></td>
                      <td><a href="#" class="btn btn-<?php echo $label_class;?> btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-<?php echo $ico; ?>"></i>
                    </span>
                    <span class="text"><?php echo $estado; ?></span>
                  </a></td>
                      <td>

                      	 <a href="entregables.php?id_p=<?php echo $codigo_; ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Entregables</span>
                  </a>
				<span class="pull-right">
					<a href="#" class='btn btn-primary' data-toggle="modal" data-target="#editProyecto"  onclick="obtener_datos(<?php echo $id;?>);"><i class="fa fa-edit"></i></a>
						<a href="#" class='btn btn-primary' title='Editar proyecto' onclick="eliminar('<?php echo $codigo_;?>');"><i class="fa fa-trash"></i></a> 
					</span>
					<p></p>
				</td>
				<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo_;?>" id="codigo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
					<input type="hidden" value="<?php echo $codigo_;?>" id="cod<?php echo $id;?>">
          <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $presupuesto;?>" id="presupuesto<?php echo $id;?>">
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



   <?php 
        $activo=mysqli_query($con,"SELECT count(*) as activo FROM proyecto where estado='activo'");
        $rwt_act=mysqli_fetch_array($activo);
        $act=$rwt_act['activo'];

        $inactivo=mysqli_query($con,"SELECT count(*) as inactivo FROM proyecto where estado='inactivo'");
        $rwt_inac=mysqli_fetch_array($inactivo);
        $inac=$rwt_inac['inactivo'];

        $terminado=mysqli_query($con,"SELECT count(*) as terminado FROM proyecto where estado='terminado'");
        $rwt_ter=mysqli_fetch_array($terminado);
        $ter=$rwt_ter['terminado'];

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
    labels: ["Activos", "Inactivos", "Terminados"],
    datasets: [{
      data: [<?php echo $act; ?>, <?php echo $inac; ?>, <?php echo $ter; ?>],
      backgroundColor: ['#f6c23e', '#e74a3b', '#6610f2'],
      hoverBackgroundColor: ['#f6c23e', '#e74a3b', '#6610f2'],
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

    <script src="vendor/jquery/jquery.min.js"></script>
 
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
