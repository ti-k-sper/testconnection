<?php
require 'connect.php';
require 'db.php';
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$sql = "DELETE FROM `user` WHERE `id`= ?";
	$statement = $pdo->prepare($sql);
	$statement->execute([$id]);
}
header("Location: profil.php");