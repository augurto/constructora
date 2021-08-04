<?php session_start();
require_once ("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("./config/conexion.php");//Contiene funcion que conecta a la base de datos

  if (!isset($_SESSION['id_user'])) {
        header("location: login.php");
    exit;
  }
  
      setlocale(LC_TIME, 'spanish');
      date_default_timezone_set("America/Lima");
      
  $solicitud="";
  $dashboard="";
  $active_grupos="";
  $proyectos=""; 
   $segmento=""; 
   $reportes=""; 

                    $cod=$_GET['cod'];
                    $proyecto=mysqli_query($con,"select * from proyecto where codigo='".$cod."'");
                   $rw=mysqli_fetch_array($proyecto);
                      $nombre=$rw["nombre_proyecto"];
                      $presupuesto=$rw["presupuesto"];
                     
                    $g=mysqli_query($con,"SELECT count(*) as entregables FROM entregables WHERE codigo_proyecto='".$cod."'");
                   $rw=mysqli_fetch_array($g);
                    $entregables=$rw["entregables"];

                     $ge=mysqli_query($con,"SELECT * FROM entregables WHERE codigo_proyecto='".$cod."'");
                   $rws=mysqli_fetch_array($ge);
                    $entregables=$rw["entregables"];

                     $te=mysqli_query($con,"SELECT count(*) te FROM usuarios where codigo_proyecto='".$cod."' AND  rol='estudiante'");
                    $rwe=mysqli_fetch_array($te);
                    $tes=$rwe["te"];

                  $c=mysqli_query($con,"SELECT * from cronograma where codigo_proyecto='".$cod."'");
                   $rwst=mysqli_fetch_array($c);
                    $fi=$rwst["fecha_inicio"];
                    $ff=$rwst["fecha_fin"];
                    $fa=date("Y-m-d");
                    $fecha1= new DateTime($ff);
                    $fecha2= new DateTime($fa);
                    $diff = $fecha1->diff($fecha2);               
                  ?>
<!DOCTYPE html>
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

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php include("modal/cambiar_password.php"); ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   <?php include('includes/menu.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include('includes/nav.php'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php  echo $nombre;?></h1>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Entregables</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $entregables;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dias restantes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  $diff->days.' dias';?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Colaboradores</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $tes;?></div>
                        </div>
                        <div class="col">
                        
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Presupuesto</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo number_format($presupuesto);?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <input type="hidden" value="<?php echo $_GET['cod'];?>" id="cod">
            <div class="col-lg-6">
              <input type="hidden" name="cx" id="cx" value="<?php echo $_GET['cod'];?>">
              <!-- Default Card Example -->
              <div class="card mb-4">
                 <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample3">
                  <h6 class="m-0 font-weight-bold text-primary">Descripcion</h6>
                </a>
                <div class="collapse show card-body" id="collapseCardExample3">
                  <?php
         $cd=$_GET['cod'];
        $descripcion=mysqli_query($con,"SELECT descripcion FROM proyecto where codigo='".$cd."'");
        $rwt=mysqli_fetch_array($descripcion);?>
<p><?php echo $rwt["descripcion"];?></p>
                </div>
              </div>

              <!-- Basic Card Example -->
              <?php if($_SESSION['prol']=="administrador" || $_SESSION['prol']=="Inv Principal" || $_SESSION['prol']=="Coinvestigador"){?>
              <div class="card shadow mb-4">
               
                 <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                  <h6 class="m-0 font-weight-bold text-primary">Miembros</h6>

                </a>
                <div class="collapse show card-body" id="collapseCardExample2">
                  
                <div class="result" id="result"></div>
                <div class="outer_divww" id="outer_divww"></div>
                </div>
              </div>
            <?php } ?>

            </div>

            <div class="col-lg-6">

              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                 <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                  <h6 class="m-0 font-weight-bold text-primary">Cronograma</h6>
                </a>
                <div class="card-body collapse show" id="collapseCardExample1">
                 <div class="col-md-8" style="font-size: 17px;"><b>Fecha de inicio</b></div>
               <div class="col-md-8"><?php echo strftime("%A, %d de %B del %Y", strtotime($fi));?></div>
               <hr>
                  <div class="col-md-8" style="font-size: 17px;"><b>Fecha de finalizacion</b></div>
                  <div class="col-md-8"><?php echo strftime("%A, %d de %B del %Y", strtotime($ff));?></div>
                </div>
              </div>
                <?php if($_SESSION['prol']=="administrador" || $_SESSION['prol']=="Inv Principal" || $_SESSION['prol']=="Coinvestigador"){?>
              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Colaborador</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                   <div class="result1" id="result1"></div>
                 <div class="outer_divyy" id="outer_divyy"></div>
                  </div>
                </div>
              </div>
            <?php } ?>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('includes/footer.php'); ?>
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
  <script src="js/info.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
