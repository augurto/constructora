<?php
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	$id=$_POST['id'];
		$sql="SELECT * FROM grupos where id='".$id."'";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
				while ($row=mysqli_fetch_array($query)){
					$sqls="SELECT * FROM programas where id='".$row['nombre_programa']."'";
		$querys = mysqli_query($con, $sqls);
		$rows=mysqli_fetch_array($querys);
					?>

						<option value="<?php echo $rows['id'];?>"><?php echo $rows['programa'];?></option>
		
			<?php	}
				?>
				
		