<?php

session_start();
session_destroy();
header("location:login.php?session_destroy=1");

?>
