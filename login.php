<?php
session_start();
if (isset($_SESSION["connect"])) {
	$connect = $_SESSION["connect"];
}else{
	$connect = false;
}
if ($connect) {
	header("Location: page.php");
}

if(!empty($_POST)){
	//var_dump($_Post);die();
	$username = strtolower($_POST["username"]);
	$password = $_POST["password"];
	$passwordVerif = $_POST["password_verif"];
	if (!empty($username) && !empty($password)) {
		require_once 'db.php';
		$sql = 'SELECT * FROM `users` WHERE `name`=?';
		$statement = $pdo->prepare($sql);
		$statement->execute([$username]);
		$user = $statement->fetch();
		if (!$user){//si l'utilisateur n'existe pas
			//die("username est unique");
			if (strlen($password) <= 10 && strlen($password) >= 5) {//vérif longueur mdp
				//die("mdp format ok");
				if ($password === $passwordVerif) {//vérif mdp
					//die("mdp identiques");
					//password_hash ( string $password , int $algo [, array $options ] ) //cryptage password
					$password = password_hash($password, PASSWORD_BCRYPT);
					require_once 'db.php';
					$sql = 'INSERT INTO `users` (`name`, `password`) VALUES (:name, :password)';// /!\ ne pas confondre value de input
					$statement = $pdo->prepare($sql);
					$result = $statement->execute([":name" => $username,
												   ":password" => $password]);
					//TODO : signaler compte créer
					if ($result) {
						//die("enregistrement sur bdd");
						$_SESSION["connect"] = true;
						$_SESSION["username"] = $username;
						header("Location: page.php");
					}else{
						//die("erreur enregistrement sur bdd");
					}
				}else{
					//die("mdp différents");
					//TODO : signaler mdp différents
				}
			}else{
				//TODO : signaler mdp trop long ou trop court
				//die("mdp trop long ou trop court");
			}
		}else{
			//TODO : signaler username existe
			//die("username existe");
		}
	}else{
		//TODO : signaler champs vide
	}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/form.css">
	<title>Formulaire d'inscription</title>
</head>
<body>
	<div class="wrapper">
		<section class="login-container">
			<div>
				<header>
					<h2>Inscription</h2>
				</header>
				<form action="" method="POST">
					<input type="text" name="username" placeholder="Nom d'utilisateur" >
					<input type="password" name="password" placeholder="Mot de passe" >
					<input type="password" name="password_verif" placeholder="Confirmez le mot de passe" >
					<button type="submit">S'enregistrer</button>
				</form>
			</div>
		</section>
	</div>
</body>
</html>
