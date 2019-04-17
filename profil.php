<?php
require 'connect.php';
require 'db.php';

$finname=substr($username, -3);
$debutname=substr($username, 0, -3);

echo "Mon profil est super sécurisé <br />";
echo "My name is {$finname} ... {$debutname}-{$finname}...<br />";

$sql = 'SELECT * FROM `user`';
$statement = $pdo->query($sql);
$users = $statement->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Mon profil</title>
	<meta charset="utf-8">
</head>
<body>
	<section>
		<h2>Liste des utilisateurs :</h2>
		<ul style="list-style-type: none;">
			<!-- liste des utilisateurs -->
			<?php foreach ($users as $user): ?>
				<li>
					<!-- - <?= $user["name"] ?> mdp : <?= $user["password"] ?> -->
					<form method="POST" action="update.php"><!-- pour modif -->
						<input type="texte" name="username" value="<?= $user['id'] ?>">
						<input type="texte" name="password" placeholder="modification mdp">
						<input type="hidden" name="id" value="<?= $user['id'] ?>">
						<button type="submit">Modifier</button>
					</form>
					<form method="POST" action="deleteprofil.php"><!-- pour suppr -->
						<input type="hidden" name="id" value="<?= $user['id'] ?>">
						<button type="submit">Supression</button>
					</form>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
	<nav>
		<a href="http://localhost/testconnection/page.php">Site</a><br />
		<a href="http://localhost/testconnection/beer.php">Les bières</a><br />
		<a href="http://localhost/testconnection/profil.php">Mon profil</a><br />
		<a href="?deconnect=true">Déconnexion</a><br />
	</nav>
</body>
</html>
