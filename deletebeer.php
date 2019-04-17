<?php
require 'connect.php';
require 'db.php';

/**
* A ne pas utiliser sauf pour select
* http://localhost/testconnection/deletebeer.php?id=
* $_GET['id']
*/

//form action "http://localhost/testconnection/deletebeer.php"
//$_POST['id']
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	//vider table /!\ => DELETE FROM `biere`
	//ex suppr ligne 1 => DELETE FROM `biere` WHERE `id`=1
	$sql = "DELETE FROM `biere` WHERE `id`= ?";
	$statement = $pdo->prepare($sql);
	$statement->execute([$id]);
	//echo $nb;
}

//header(location: beer.php)
header("Location: beer.php");