<?php 
$entregable=$_GET["id_est"];
$name_entregable=$_POST["entregable"];
$est=$_GET["id_est"];

$direccion=$_GET["id_p"];
$carpeta='archivos/'.$direccion.'/'.$name_entregable;
/* $carpeta='archivos/proyectos/'.$direccion; */
$nombre=$_FILES['archivo']['name'];
$guardado=$_FILES['archivo']['tmp_name'];

$servername = "localhost";
$database = "u415020159_constructora";
$username = "u415020159_constructora";
$password = "Constructora*#17";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";
 
$sql = "INSERT INTO archivos (codigo_proyecto, documento,id_seg,id_miembros) VALUES ('$direccion', '$nombre','$entregable','$est')";

if (mysqli_query($conn, $sql)) {

if(!file_exists($carpeta)){
	mkdir($carpeta,0777,true);
	if(file_exists($carpeta)){
		if(move_uploaded_file($guardado, $carpeta.'/'.$nombre)){
			echo "Archivo guardado con exito";
		}else{
			echo "Archivo no se pudo guardar";
		}

	}
}else{
	if(move_uploaded_file($guardado, $carpeta.'/'.$nombre)){
	
        echo "Archivo guardado con exito";
	}else{
		echo "Archivo no se pudo guardar o no seleciono ningun archivo";
	}
}
/* header("Location: ver_entregables.php?var1=$direccion"); */
header("Location: ver_entregables.php?id_p=$direccion&id_est=$est");
exit;

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>