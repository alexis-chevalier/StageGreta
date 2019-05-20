<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
	$conn = include('./connexion_bdd.php');
?>

<html>
	<head>
		<title>Consultation de la Base de Données</title>
	</head>
	<body>
		<?php include('./header.php'); ?>
		<h1>Consultation de la Base de Données</h1>
		<br>
		<form name="donnees" action="insert_agence.php" method="POST">
			<select name="donnees" selected="0" onchange="document.location.href=this.value">
				<option value="">----------------</option>
				<option value="./consultBDDagence.php">Agence</option>
				<option value="./consultBDDsite.php">Site</option>
				<option value="./consultBDDform.php">Formation</option>
				<option value="./consultBDDbloc.php">Bloc de compétences</option>
				<option value="./consultBDDcomp.php">Compétence</option>
			</select>
		</form>
	</body>
</html>