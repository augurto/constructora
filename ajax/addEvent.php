<?php
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
require_once('../bdd.php');

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = mysqli_real_escape_string($con,(strip_tags($_POST['title'])));
	$start = mysqli_real_escape_string($con,(strip_tags($_POST['start'])));
	$end = mysqli_real_escape_string($con,(strip_tags($_POST['end'])));
	$color = mysqli_real_escape_string($con,(strip_tags($_POST['color'])));

	$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);
	
?>
