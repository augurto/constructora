<?php
sleep(3);
session_start();

require_once ("../config/db.php");
require_once ("../config/conexion.php");


if(isset($_POST["username"]) && isset($_POST["password"])){
  $username = mysqli_real_escape_string($con, $_POST["username"]);
  $password = mysqli_real_escape_string($con,  sha1($_POST["password"]));
  $sql = "SELECT username,id,rol, codigo_proyecto FROM usuarios WHERE username='$username' AND password='$password' GROUP BY username";
  $result = mysqli_query($con, $sql);
  $num_row = mysqli_num_rows($result);
  if ($num_row == "1") {
    $data = mysqli_fetch_array($result);
    $_SESSION["username"] = $data["username"];
	$_SESSION["id_user"] = $data["id"];
    $_SESSION["prol"] = $data["rol"];
     $_SESSION["codigo"] = $data["codigo_proyecto"];
    echo "1";
  } else {
    echo "error";
  }
} 

?>
