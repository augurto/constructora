<?php
$codigo=$_GET['codigo'];
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		$sql=mysqli_query($con,"SELECT * FROM usuarios WHERE codigo_proyecto='$codigo'");
			
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'mail.edeproca.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "admin@edeproca.com";
$mail->Password = "cartagena2020";

while ($row=mysqli_fetch_array($sql)){
$username=$row['username'];
$rol=$row['rol'];
$codigo_proyecto=$row['codigo_proyecto'];

 $g=mysqli_query($con,"SELECT *  FROM proyecto WHERE codigo='".$codigo_proyecto."'");
  $rw=mysqli_fetch_array($g);
  $nombre_proyecto=$rw["nombre_proyecto"];

$mail->setFrom('edeproca@edeproca.com', 'SISTEMA DE GESTION DE PROYECTO');
$mail->addAddress($username);
$mail->Subject = "SISTEMA DE GESTION DE PROYECTO";
$mail->msgHTML('<br>Buen dia :)<br>El presente correo  es para informarle que usted ha sido integado(a) al proyecto '.$nombre_proyecto.'. con el rol de '.$rol.' Le invitamos a que acceda al sistema y se ponga a la mano con el proyecto.<br>Hasta pronto que tenga un buen dia.');
				}



if (!$mail->send()) echo "Mailer Error: " . $mail->ErrorInfo;
else echo "Message sent!";



?>