<?php session_start();
  if (!isset($_SESSION['id_user'])) {
        header("location: login.php");
    exit;
  }
  if ($_SESSION['prol']=="administrador" || $_SESSION['prol']=="Jefe Proyecto"  || $_SESSION['prol']=="Supervisor" || $_SESSION['prol']=="Colaborador"){
      

  }else{
     header("location: index.php"); 
  }
  /* Connect To Database*/
  require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
  

  

  $solicitud="active";
  $dashboard="";
  $active_grupos="";
  $proyectos=""; 
   $segmento="active"; 
   $reportes="active";  

      $est=$_GET['id_est'];
       $id_p=$_GET['id_p'];
     $sql=mysqli_query($con,"SELECT * FROM miembros WHERE id='".$est."'");
      $rws=mysqli_fetch_array($sql);
      $nombre=$rws["nombre"];

      ?><!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Audra</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="css/facebook.css">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<?php 
      include("modal/agregar_programas.php");
       include("modal/editar_programas.php");
       include("modal/cambiar_password.php");
       include("modal/comments.php");
       ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('includes/menu.php');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <?php  include('includes/nav.php');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
             <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b><?php echo $nombre; ?> </b></h1>
          </div>
            
            <div>

                <h1>Subir archivos</h1>
                    <form action='sube.php?id_p=<?php echo $_GET['id_p'];?>&id_est=<?php echo $_GET['id_est'];?>' method="post" enctype="multipart/form-data">
                        <input type="file" name="archivo">
                        <br><br>
                        <button>Subir Archivo</button>

                        <label>Listar version</label>
                            <select class="selectpicker" data-show-subtext="true" data-live-search="true" name="entregable" id="entregable">
                                <?php
                                include "DB/db.php";
                                $con = connect();
                                if (!$con->set_charset("utf8")) {//asignamos la codificación comprobando que no falle
                                    die("Error cargando el conjunto de caracteres utf8");
                                }
                                    $consulta = "SELECT * FROM entregables where codigo_proyecto=$id_p";
                                    $resultado = mysqli_query($con , $consulta);
                                    $contador=0;

                                while($misdatos = mysqli_fetch_assoc($resultado)){ $contador++;?>
                                
                                    <option data-subtext="<?php echo $misdatos["codigo_proyecto"]; ?>"><?php echo $misdatos["nombre"]; ?></option>
                                <?php }?>          
                            </select>
                    </form>


            </div>  



          <!-- DataTales Example -->
          <div class="row">
          <?php $sql="SELECT * FROM  seguimientos WHERE codigo_proyecto='$id_p' AND id_miembros='$est'";
             $query = mysqli_query($con, $sql);
          while ($row=mysqli_fetch_array($query)){
           $id=$row['id'];
            $id_seg=$row['id_seg'];
            $descripcion=$row['descripcion'];
             $documento=$row['documento'];

            $gd=mysqli_query($con,"SELECT * FROM entregables WHERE  id='".$id_seg."' AND codigo_proyecto='".$id_p."'");
            $rwd=mysqli_fetch_array($gd);
            $nom=$rwd["nombre"];
              $id_ent=$rwd["id"];

            $t=mysqli_query($con,"SELECT count(*) as t FROM comments WHERE codigo_proyecto='".$id_p."' AND id_seguimiento='".$id."' AND id_entregable='".$id_ent."'");
            $rwdt=mysqli_fetch_array($t);
            $ts=$rwdt["t"];

         ?>
             


         <!-- 
          <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $nom; ?></h6>
                 
                </div>
             
                <div class="card-body">
                  <a href="#" data-toggle="modal" data-target="#comments" onclick="comments(<?php echo $id_ent; ?>, <?php echo $id; ?>);">
                <?php echo $ts; ?> <i class="fas fa-comments fa-fw"></i>
              
              </a>
                  <div  align="center"><img src="img/file.png" width="40px" height="auto"></div>
                  <div align="center"><a href="entregables/<?php echo  $documento; ?>" download="entregables/<?php echo  $documento; ?>"><i class="fa fa-download"></i> Descargar</a></div>
                  <br>
               <?php echo $descripcion; ?>
                </div>
              </div>
            </div> -->



          <?php } ?>
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
   <script type="text/javascript" src="js/comments.js"></script>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
