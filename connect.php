<?php
session_start();
if(isset($_GET["deconnect"]) && $_GET["deconnect"]){//variable bien déclaré
	unset($_SESSION["connect"]);
}
if (isset($_SESSION["connect"])) {
	$connect = $_SESSION["connect"];
}else{
	$connect = false;
}
if (empty($connect)) {
	header("Location: /testconnection/");
}
if (isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
}else{
	$username = "";
}
//ne pas fermer la balise sinon pb pour require ds autre php