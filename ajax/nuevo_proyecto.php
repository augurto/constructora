<?php
$mysqli = new mysqli("localhost","u415020159_constructora","Constructora*#17", "u415020159_constructora");

if($mysqli -> connect_errno){
echo "BD".$mysqli->connect_error;
}
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
  require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
$codig=$_GET['codigo'];
 $sql = "SELECT * FROM proyecto WHERE codigo='".$codig."'";
  $result = mysqli_query($con, $sql);
  $num_row = mysqli_num_rows($result);
  if ($num_row == "0") {

if(isset($_POST['entregable'])){
$entregable=$_POST['entregable'];
$f=$_POST['f'];
$codigo=$_GET['codigo'];
$entreg = "INSERT INTO entregables (id, 	codigo_proyecto,  nombre, fecha_entrega)  VALUES ";

for ($i=0; $i < count($entregable); $i++){
$entreg.="(null, '".$codigo."', '".$entregable[$i]."', '".$f[$i]."'),";
}
$entreg_final= substr($entreg, 0, -1);
$entreg_final.=";";
if ($mysqli->query($entreg_final)):
echo '';
else:
echo '';
endif;
}


if(isset($_POST['nombre'])){
$nombre=mysqli_real_escape_string($con,(strip_tags($_POST['nombre'])));
$codigo=mysqli_real_escape_string($con,(strip_tags($_GET['codigo'])));
$estado="activo";
$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST['descripcion'])));
$presupuesto=mysqli_real_escape_string($con,(strip_tags($_POST['presupuesto'])));

$proyecto=("INSERT INTO proyecto (id, 	codigo, nombre_proyecto, presupuesto, descripcion, estado, fecha_agregado)  VALUES (null, '".$codigo."', '".$nombre."', '".$presupuesto."',  '".$descripcion."', '".$estado."', now());");
if ($mysqli->query($proyecto)):
echo '';
else:
echo '';
endif;
}


if(isset($_GET['grupos'])){
$codigo=$_GET['codigo'];
$grupos=$_GET['grupos'];
$grp=("INSERT INTO `grupo_proyecto` (`id`, `id_grupo`, `codigo_proyecto`) VALUES (null, '".$grupos."', '".$codigo."');");
if ($mysqli->query($grp)):
echo '';
else:
echo '';
endif;
}

if(isset($_POST['programa'])){
$codigo=$_GET['codigo'];
$programa=$_POST['programa'];
$program=("INSERT INTO programa_proyecto (id, id_programa, codigo_proyecto)  VALUES (null, '".$programa."', '".$codigo."');");
if ($mysqli->query($program)):
echo '';
else:
echo '';
endif;
}

if(isset($_POST['fecha_ini']) && isset($_POST['fecha_fin'])){
$codigo=$_GET['codigo'];
$fecha_in=$_POST['fecha_ini'];
$fecha_f=$_POST['fecha_fin'];
$cronograma=("INSERT INTO cronograma (id, codigo_proyecto, fecha_inicio, fecha_fin)  VALUES (null, '".$codigo."', '".$fecha_in."', '".$fecha_f."');");
if ($mysqli->query($cronograma)):
echo '1';
else:
echo '';
endif;
}
}else{
	echo '<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Disculpe!</strong> ya existe un proyecto con este codigo.
			</div>';
}

    
?>