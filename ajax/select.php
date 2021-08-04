<?php
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
 $cd=$_GET['cd'];
  $p=mysqli_query($con,"select * from proyecto where id='".$cd."'");
$rws=mysqli_fetch_array($p);
                      $codigo=$rws["codigo"];
                      ?>
<option value="">--Seleccione el entregable--</option>
					 <?php
										$ent=mysqli_query($con,"select * from entregables where codigo_proyecto='".$codigo."'");
										while ($rw=mysqli_fetch_array($ent)){
											$id=$rw["id"];
											$nombre=$rw["nombre"];
											?>
											<option value="<?php echo $id?>"><?php echo $nombre?></option>
											<?php
										}
									?>