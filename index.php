<?php
session_start();
if (isset($_SESSION["connect"])) {
	$connect = $_SESSION["connect"];
}else{
	$connect = false;
}
if ($connect) {
	header("Location: http://localhost/testconnection/page.php");
	//fin traitement
}
$errusername="";
$errpassword="";
if(!empty($_POST)){
	//var_dump($_Post);die();
	$stock = require 'stock.php';
	$username = strtolower($_POST["username"]);
	$password = $_POST["password"];
	if (!empty($username) && !empty($password)) {
		//récupération users
		require_once 'db.php';
		$sql = 'SELECT * FROM `user` WHERE `name`=?';
		$statement = $pdo->prepare($sql);
		$statement->execute([$username]);
		$user = $statement->fetch();
		/*verifier couple / mdp*/
		//die("test logique");
		if ($user) {
			//die("user existe");
			//password_verify( string $password , string $hash )//verif password crypté
			if (password_verify($password, $user["password"])) {
				//die("connecté");
				$_SESSION["connect"] = true;
				$_SESSION["username"] = $username;
				header("Location: http://localhost/testconnection/page.php");//prendre url au lieu du fichier
				//header("Location: http://localhost/testconnection/profil.php");
			}else{
				header("HTTP/1.0 403 Forbidden");
				//die("mot de passe pas bon");
				/*username ou mdp pas bon*/
			}
		}else{
			header("HTTP/1.0 403 Forbidden");
			//die("username n'existe pas");
			/*username ou mdp pas bon*/
		}
	}else{
		//die("champ vide");
		/*TODO : signaler qu'il manque un champ*/
		if(empty($username)){
			$errusername="class=\"danger\"";
		}
		if (empty($password)) {
			$errpassword="class=\"danger\"";
		}
	}
	
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/form.css">
	<title>Formulaire de connexion</title>
</head>
<body>
	<div class="wrapper">
		<section class="login-container">
			<div>
				<header>
					<h2>Identification</h2>
				</header>
				<form action="" method="POST">
					<input <?= $errusername ?> type="text" name="username" placeholder="Nom d'utilisateur" required="required">
					<input <?= $errpassword ?> type="password" name="password" placeholder="Mot de passe" required="required">
					<button type="submit">Connexion</button>
				</form>
			</div>
		</section>
	</div>
</body>
</html>