<?php session_start();
  if (!isset($_SESSION['id_user'])) {
        header("location: login.php");
    exit;
  }
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  
  $solicitud="";
  $dashboard="";
  $active_grupos="";
  $proyectos="active"; 
   $segmento=""; 
   $reportes=""; 
   ?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Audra</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="css/facebook.css">
</head>

<body id="page-top">
<?php
include('modal/editar_proyecto.php');
include('modal/seguimientos.php');
include('modal/nuevo_proyecto.php');
include("modal/cambiar_password.php");
 ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php 
    include('includes/menu.php');

    
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('includes/nav.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Mesa de trabajo</b></h1>
            <?php if($_SESSION['prol']=='administrador'){?>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-toggle="modal" data-target="#NuevoProyecto"><i class="fas fa-folder fa-sm text-white-50"></i> Nuevo proyecto</a>
          <?php } ?>
          </div>
 <?php if($_SESSION['prol']=="administrador"){?>
          <!-- Content Row -->
          <div class="row">
            
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Estadistica de presupuesto</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Estadistica</h6>
            
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-warning"></i> Activo
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-danger"></i> Inactivo
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Terminado
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

           <div id="resultados"></div><!-- Carga los datos ajax -->
           <?php if($_SESSION['prol']=="administrador"){?>
        <div class='outer_div'></div><!-- Carga los datos ajax -->
      <?php }?>
      <?php if($_SESSION['prol']=="Inv Principal"){ ?>
        <input type="hidden" id="cx" value="<?php echo $_SESSION['username'];?>">
        <div class='outer_divx'></div><!-- Carga los datos ajax -->
      <?php } ?>
        <?php if($_SESSION['prol']=="Colaborador"){ ?>
        <input type="hidden" id="cs" value="<?php echo $_SESSION["id_user"];?>">
        <div class='outer_divs'></div><!-- Carga los datos ajax -->
      <?php } ?>
       <?php if($_SESSION['prol']=="Coinvestigador"){ ?>
        <input type="hidden" id="cx" value="<?php echo $_SESSION['username'];?>">
        <div class='outer_divx'></div><!-- Carga los datos ajax -->
      <?php } ?>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('includes/footer.php');?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
 <?php include('modal/logout.php'); ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/proyecto.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
 <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->

  <?php $sql="SELECT proyecto.presupuesto, COUNT(entregables.codigo_proyecto) as total FROM proyecto, entregables WHERE proyecto.codigo=entregables.codigo_proyecto group by proyecto.codigo";
    $query = mysqli_query($con, $sql); 

     $sql2="SELECT proyecto.nombre_proyecto, COUNT(entregables.codigo_proyecto) as total FROM proyecto, entregables WHERE proyecto.codigo=entregables.codigo_proyecto group by proyecto.codigo";
    $query2 = mysqli_query($con, $sql2); 

    
    ?>
<script type="text/javascript">
$(document).ready(function(){
  grafica();
})

  function grafica(){
  // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
var hola=[<?php while ($row=mysqli_fetch_array($query)){?>"<?php echo $row['presupuesto'];  ?>",<?php } ?>];
var hol=[<?php while ($row2=mysqli_fetch_array($query2)){?>"<?php echo $row2['nombre_proyecto'];  ?>",<?php } ?>];
// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: hol,
    datasets: [{
      label: "presupuesto",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: hola,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a sol sign in the ticks
          callback: function(value, index, values) {
            return 'S/' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': S/' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
}
</script>
  
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
