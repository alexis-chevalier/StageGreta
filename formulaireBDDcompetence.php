<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
	$conn = include('./connexion_bdd.php');
?>

<html>
		<head>
			<title>Insertion de compétences</title>
			<link rel="stylesheet" href="css/formulaire.css">
			<link rel="stylesheet" href="css/header.css">
	</head>
	<body>
		<?php include('./header.php'); ?>
		<br><br>
		<h1>Insertion de compétences</h1>
		<br>
		<form name="formulaire" action="insert_competence.php" method="POST">
			Compétence<br>
			<input type="text" id="Competence" name="Competence" style="width:1000px">
			<br><br>
			<label for="Bloc">Bloc de compétence</label><br>
			<select id="Bloc" name="Bloc" selected="0">
				<option value="0"></option>
				<?php
					$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
					$retour=$connexion->query("SELECT DISTINCT id_bloc,Nom FROM competence_bloc ORDER BY Nom ASC");
			
					while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
					{
						echo '<option value="';
						echo utf8_encode($donnees['id_bloc']);
						echo '">';
						echo utf8_encode($donnees['Nom']);
						echo '</option>';
					}
				?>
			</select><br><br>
			<input type="submit" value="Ajouter"></button>
			<br><br>
			<br><br>
			OU
			<br><br>
		</form>
<?php
	include('./insert_comptab.php');
?>
	</body>
</html>