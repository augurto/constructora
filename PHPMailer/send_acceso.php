<?php
$email=$_POST['username'];
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		$sql=mysqli_query($con,"SELECT * FROM miembros WHERE email='$email'");
			
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
$email=$row['email'];
$nombre=$row['nombre'];
$rand=$row['rand'];
$rol=$row['rol'];
$mail->setFrom($email, $nombre);

						$mail->addAddress($email, $nombre);
$mail->Subject = "SISTEMA DE GESTION DE PROYECTO";
$mail->msgHTML('<br><p>Buen dia :) <br> El presente correo  es para informarle que usted ha sido registrado(a) al sistema. con el rol de '.$rol.' <br>Le hemos otorgado un acceso, el cual se encuentra bloqueado por el momento hasta que se admita o integre a un proyecto<br>Le estaremos notificando cuando se ingrese a un proyecto.<br>ACESSO AL SISTEMA.<br>CORREO:'.$email.'<br>CLAVE:'.$rand.'<br>Hasta pronto que tenga un buen dia.');
				}



if (!$mail->send()) echo "Mailer Error: " . $mail->ErrorInfo;
else echo "Message sent!";



?>