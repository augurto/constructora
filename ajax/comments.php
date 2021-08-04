<style type="text/css">
	.comment {
    display: block;
    position: relative;
    margin-bottom: 30px;
    padding-left: 66px;
}
.comment .comment-author-ava {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    border-radius: 50%;
    overflow: hidden;
}
.comment .comment-body {
    position: relative;
    padding: 7px;
    border: 1px solid #e1e7ec;
    border-radius: 7px;
    background-color: #fff;
}
.comment .comment-body::before {
    margin-top: -1px;
    border-width: 10px;
    border-color: transparent;
    border-right-color: #e1e7ec;
}
.comment .comment-body::after, .comment .comment-body::before {
    position: absolute;
    top: 12px;
    right: 100%;
    width: 0;
    height: 0;
    border: solid transparent;
    content: '';
    pointer-events: none;
}
.comment .comment-text {
    margin-bottom: 5px;
}
.comment .comment-footer {
    display: table;
    width: 100%;
}

.comment .comment-body::after {
    border-width: 9px;
    border-color: transparent;
    border-right-color: #fff;
    border:1px solid;
}
.comment .comment-author-ava {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 50px;
    border-radius: 50%;
    overflow: hidden;
}
</style>
<?php
session_start();  
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$idd=intval($_GET['id']);
			if ($delete1=mysqli_query($con,"DELETE FROM comments WHERE id='".$idd."'")){
			?>
			
			<?php 
		}else {
			?>
			
			<?php
			
		}
			
		
		
	}
		setlocale(LC_TIME, 'spanish');
		$id_proyecto=$_GET['id_proyecto'];
		$id_estudiante=$_GET['id_estudiante'];
		$id_seguimiento=$_GET['id_seguimiento'];
		$id_entregable=$_GET['id_entregable'];

		$sql="SELECT * FROM  comments where codigo_proyecto='$id_proyecto' AND id_seguimiento='$id_seguimiento' AND id_entregable='$id_entregable'";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
			
			?><?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$id_user=$row['id_user'];
						$comentario=$row['comentario'];
						$rol=$row['rol'];
        
        
        	 $s=mysqli_query($con,"SELECT * FROM usuarios WHERE id='".$id_user."'");
                   		$rwse=mysqli_fetch_array($s);
                   		 $username=$rwse["username"];

                   		 if($rol=='estudiante'){
                   		 	$var='';
                   		 	$img='default-user.png';
                   		 }else{
                   		 	$var='background: azure;';
                   		 	$img='usericon.png';
                   		 }
					?>

			<div class="comment">
				<div class="comment-author-ava"><img src="img/<?php echo $img; ?>" alt="Avatar" style="width: 50px;"></div>
              <div class="comment-body" style="<?php echo $var; ?>">
                <p class="comment-text" style="font-size: 13px;"><?php echo $comentario; ?></p>
                <div class="comment-footer"><span class="comment-meta" style="text-transform: capitalize;font-size: 13px;"><?php echo $rol.' ->'.$username; ?></span></div>
              </div>
            </div>
			<?php
	}
?>
