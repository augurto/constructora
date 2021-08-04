<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=u415020159_constructora;charset=utf8', 'u415020159_constructora', 'Constructora*#17');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}
