<?php
	if (empty($_POST['investigador'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['investigador'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$investigador=mysqli_real_escape_string($con,(strip_tags($_POST["investigador"],ENT_QUOTES)));
		$rol=mysqli_real_escape_string($con,(strip_tags($_POST["rol"],ENT_QUOTES)));
		$c=mysqli_real_escape_string($con,(strip_tags($_POST["c"],ENT_QUOTES)));
		 $invs=mysqli_query($con,"select * from miembros where id='".$investigador."'");
                    $rw=mysqli_fetch_array($invs);
                      $nombre=$rw["nombre"];
                        $email=$rw["email"];
                        $rand=$rw["rand"];
		$sql2 = "SELECT * FROM investigadores_proyecto WHERE investigador = '" . $investigador . "' and codigo_proyecto='".$c."';";
                $query_check_user_name = mysqli_query($con,$sql2);
				$query_check_user=mysqli_num_rows($query_check_user_name);

                if ($query_check_user == 1) {
                    $errors[] = "ya el investigador está asociado.";
                } else {
		$sql="INSERT INTO  investigadores_proyecto (codigo_proyecto, investigador, rol) VALUES ('$c', '$investigador', '$rol')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				if($rol=='Inv Principal' || $rol=='Coinvestigador'){
					$sha=sha1($rand);
					$sql2="INSERT INTO  usuarios (username, password, rol, codigo_proyecto) VALUES ('$email', '$sha', '$rol', '$c')";
		$query_new_insert2 = mysqli_query($con,$sql2);
				}
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