<?php		
session_start();  
		if (empty($_POST['comentario'])){
			$errors[] = "Comentario vacío";
		}elseif (empty($_POST['idd_proyecto'])) {
          $errors[] = "ID vacía";
        } elseif (!empty($_POST['comentario'])
     && !empty($_POST['id_ent'])  && !empty($_POST['id_est'])) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                 $id_p = mysqli_real_escape_string($con,(strip_tags($_POST["idd_proyecto"],ENT_QUOTES)));
                 $id_est = mysqli_real_escape_string($con,(strip_tags($_POST["id_est"],ENT_QUOTES)));
                   $id_ent = mysqli_real_escape_string($con,(strip_tags($_POST["id_ent"],ENT_QUOTES)));
                    $id_seg = mysqli_real_escape_string($con,(strip_tags($_POST["id_seg"],ENT_QUOTES)));
                    $comentario = mysqli_real_escape_string($con,(strip_tags($_POST["comentario"],ENT_QUOTES)));
                 $id_user = $_SESSION['id_user'];
                  $rol = $_SESSION['prol'];
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
       $sql = "INSERT INTO comments (codigo_proyecto, id_seguimiento, id_entregable, comentario, id_user, rol) VALUES ('$id_p', '$id_seg','$id_ent','$comentario','$id_user','$rol');";
                    $query_new_user_insert = mysqli_query($con,$sql);
                    if ($query_new_user_insert) {
                        $messages[] = "Publicado con exito.";
                    } else {
                        $errors[] = "Lo sentimos , la publicacion falló. Por favor, regrese y vuelva a intentarlo.";
                    }
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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
				<div class="alert alert-success" role="alert">
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