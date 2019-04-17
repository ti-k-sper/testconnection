<?php
require 'connect.php';

echo "Bonjour {$username}...<br />";
echo "super site <br />";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Page</title>
	<meta charset="utf-8">
</head>
<body>
	<section>
		
	</section>
	<nav>
		<a href="http://localhost/testconnection/page.php">Site</a><br />
		<a href="http://localhost/testconnection/beer.php">Les bières</a><br />
		<a href="http://localhost/testconnection/profil.php">Mon profil</a><br />
		<a href="?deconnect=true">Déconnexion</a><br />
	</nav>
</body>
</html>
