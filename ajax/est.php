<?php
	if (empty($_POST['estudiante'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['estudiante'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$estudiante=mysqli_real_escape_string($con,(strip_tags($_POST["estudiante"],ENT_QUOTES)));
		$ce=mysqli_real_escape_string($con,(strip_tags($_POST["ce"],ENT_QUOTES)));
		 $es=mysqli_query($con,"select * from miembros where id='".$estudiante."'");
                    $rw=mysqli_fetch_array($es);
                      $nombre=$rw["nombre"];
                       $email=$rw["email"];
                        $rand=$rw["rand"];
		$sql2 = "SELECT * FROM estudiantes_proyecto WHERE estudiante = '" . $estudiante . "' and codigo_proyecto='".$ce."';";
                $query_check_user_name = mysqli_query($con,$sql2);
				$query_check_user=mysqli_num_rows($query_check_user_name);

                if ($query_check_user == 1) {
                    $errors[] = "ya el estudiante está asociado.";
                } else {
		$sql="INSERT INTO  estudiantes_proyecto (codigo_proyecto, estudiante) VALUES ('$ce', '$estudiante')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
					$sha=sha1($rand);
					$sql2="INSERT INTO  usuarios (username, password, rol, codigo_proyecto) VALUES ('$email', '$sha', 'estudiante', '$ce')";
		$query_new_insert2 = mysqli_query($con,$sql2);
				$messages[] = "Ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
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