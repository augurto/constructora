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

          <!-- DataTales Example -->
          <div class="row">
          <?php $sql="SELECT * FROM  archivos WHERE codigo_proyecto='$id_p' ";
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
          

          <?php } ?>
        </div>

        </div>
        <!-- /.container-fluid -->
        <?php
                function myFunction() {
                    if(confirm("Desea guardar los datos?")){
                    alert("Datos guardados exitosamente");
                    }else{
                    alert("Usted cancelo la acción para guardar");
                    }
              }
                $codigo=$_GET["id_p"];
                //Creamos Nuestra Función
                function listFiles($directorio){ //La función recibira como parametro un directorio
                if (is_dir($directorio)) { //Comprobamos que sea un directorio Valido
                if ($dir = opendir($directorio)) {//Abrimos el directorio
                echo '<ul>'; //Abrimos una lista HTML para mostrar los archivos
                while (($archivo = readdir($dir)) !== false){ //Comenzamos a leer archivo por archivo
                if ($archivo != '.' && $archivo != '..'){//Omitimos los archivos del sistema . y ..
                $nuevaRuta = $directorio.$archivo.'/';//Creamos unaruta con la ruta anterior y el nombre del archivo actual 
                echo '<li>'; //Abrimos un elemento de lista 
                if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un directorio entonces:
                echo '<b>'.$nuevaRuta.'</b>'; //Imprimimos la ruta completa resaltandola en negrita
                listFiles($nuevaRuta);//Volvemos a llamar a este metodo para que explore ese directorio.
                } else { //si no es un directorio: 
                
                //echo 'Archivo: '.$archivo; //simplemente imprimimos el nombre del archivo actual
                $ruta_archivo = $directorio.$codigo.'/'.$archivo.""; //agregamos el $codigo + '/' para especificar la ruta en la que se encuentra el archivo
                $ruta_carpeta =$_GET["id_p"];
                echo "<a href='$ruta_archivo' target='_blank'>Archivo: $archivo</a>";
                echo "<a href='borrar.php?borrar=$ruta_archivo&reload=$ruta_carpeta' target='_blank'>Eliminar</a>";
                
                   
              
                }
                '</li>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
                }
                }//finaliza While
                echo '</ul>';//Se cierra la lista 
                closedir($dir);//Se cierra el archivo
               
                }
                }else{//Finaliza el If de la linea 12, si no es un directorio valido, muestra el siguiente mensaje
                echo 'No Existe el directorio';
                echo'	<a href="crear_carpeta.php?codigo='.$_GET["id_p"].'">Crear carpeta</a>';
                
                
                    
                }
               
                }//Fin de la Función	 
                //Llamamos a la función y le pasamos el nombre de nuestro directorio.
                listFiles("archivos/");

                ?>


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
