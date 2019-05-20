<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
	$conn = include('./connexion_bdd.php');
?>

<html>
	<head>
		<title>Insertion d'une agence</title>
		<link rel="stylesheet" href="css/formulaire.css">
	</head>
	<body>
		<?php include('./header.php'); ?>
		<br><br>
		<h1>Insertion d'une agence</h1>
		<br>
		<form name="formulaire" action="insert_agence.php" method="POST">
			<label for="agence">Nom de l'Agence :</label><br>
			<input type="text" id="agence" name="agence">
			<br><br>
			<input type="submit" value="Ajouter"></button>
		</form>
	</body>
</html>	