<?php
	include("test_cookie.php"); //On test les cookies et si il n'y a pas de cookie alors on affiche la page de connexion
?>
<html>
	<head>
		<title>Connexion</title>
		<script type="text/javascript" src="js/connexion.js"></script>
		<link rel="stylesheet" href="css/general.css">
		<meta charset="UTF-8">
	</head>
	<body>
		<?php include('./header_connexion.php'); ?>
		<form name="formulaire" action="connexion.php" method="POST">
		<h1> Connexion </h1>
		<label for="mail">Mail</label><br>
		<input type="text" id="mail" name="mail"></input>
		<br><br>
		<label for="pass">Mot de passe</label><br>
		<input type="password" id="pass" name="pass"></input>
		<br><br>
		<input type="button" value="Se connecter" onclick="controller()"></button>
		</form>
	</body>
</html>