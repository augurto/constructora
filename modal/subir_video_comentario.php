<?php 

$direccion=$_GET["nom"];
$nombre=$_FILES['archivo']['name'];
$guardado=$_FILES['archivo']['tmp_name'];

if(!file_exists('archivos')){
	mkdir('archivos',0777,true);
	if(file_exists('archivos')){
		if(move_uploaded_file($guardado, 'archivos/'.$direccion.'/'.$nombre)){
			echo "Archivo guardado con exito";
		}else{
			echo "Archivo no se pudo guardar";
		}
	}
}else{
	if(move_uploaded_file($guardado, 'archivos/'.$direccion.'/'.$nombre)){
	
        echo "Archivo guardado con exito";
	}else{
		echo "Archivo no se pudo guardar o no seleciono ningun archivo";
	}
}
header("Location: portafolio.php?var1=$direccion");
exit;
?>