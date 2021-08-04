<?php
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			!empty($_POST['mod_codigo']) &&
			!empty($_POST['mod_descripcion']) &&
			!empty($_POST['mod_presupuesto'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$presupuesto=mysqli_real_escape_string($con,(strip_tags($_POST["mod_presupuesto"],ENT_QUOTES)));
		$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_descripcion"],ENT_QUOTES)));
		$id=intval($_POST['mod_id']);
		$cod=intval($_POST['mod_cod']);	
		$estado=$_POST['mod_estado'];
		$sql="UPDATE proyecto SET nombre_proyecto='".$nombre."', codigo='".$codigo."', presupuesto='".$presupuesto."', descripcion='".$descripcion."', estado='".$estado."' WHERE id='".$id."'";
		$query_update = mysqli_query($con,$sql);

		$sql2="UPDATE grupo_proyecto SET codigo_proyecto='".$codigo."' WHERE codigo_proyecto='".$cod."'";
		$query_update2 = mysqli_query($con,$sql2);

		$sql3="UPDATE estudiantes_proyecto SET codigo_proyecto='".$codigo."' WHERE codigo_proyecto='".$cod."'";
		$query_update3 = mysqli_query($con,$sql3);


		$sql4="UPDATE investigadores_proyecto SET codigo_proyecto='".$codigo."' WHERE codigo_proyecto='".$cod."'";
		$query_update4 = mysqli_query($con,$sql4);

		$sql5="UPDATE programa_proyecto SET codigo_proyecto='".$codigo."' WHERE codigo_proyecto='".$cod."'";
		$query_update5 = mysqli_query($con,$sql5);
			if ($query_update){
				$messages[] = "Actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-info" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>