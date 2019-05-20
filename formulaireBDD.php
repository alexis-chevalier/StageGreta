<?php
	include('./test_connecter.php');
?>

<html>
	<head>
			<title>Insertion de données</title>
			<link rel="stylesheet" href="css/formulaire.css">
	</head>
	<body>
		<?php include('./header.php'); ?>
		<form  action="formulaireBDDagence.php" name="formulaire" method="POST">
		<h1>Insertion de données</h1>
		<br>
			Selectionner le type de données à insérer :<br><br>
			<select name="agence" selected="0" onchange="document.location.href=this.value">
				<option value="">----------------</option>
				<option value="./formulaireBDDagence.php">Agence</option>
				<option value="./formulaireBDDsite.php">Site</option>
				<option value="./formulaireBDDformation.php">Formation</option>
				<option value="./formulaireBDDcompetence.php">Compétence</option>
				<option value="./formulaireBDDbloc.php">Bloc de compétence</option>
			</select>
		<form>
	</body>
</html>	