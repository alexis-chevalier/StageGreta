<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
?>

<html>
		<head>
			<title>Insertion d'un bloc de compétences</title>
			<link rel="stylesheet" href="css/formulaire.css">
	</head>
	<body>
		<?php include('./header.php'); ?>
		<br><br>
		<h1>Insertion d'un bloc de compétences</h1>
		<form name="formulaire" action="insert_bloc.php" method="POST">
			<label for="formation">Formation associée</label><br>
			<select id="formation" name="formation">
			<?php
				include('./connexion_bdd.php');
				$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
				$retour=$connexion->query("SELECT id_formation,Titre FROM liste_formation ORDER BY Titre ASC");
				echo "<option value=''";
				echo " selected='selected' ></option>";
				while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
				{
					echo "<option ";
					echo 'value="';
					echo utf8_encode($donnees['id_formation']);
					echo '">';
					echo utf8_encode($donnees['Titre']);
					echo '</option>';
				}
		?>
		</select>
			<br><br>
			Titre du bloc de compétences<br>
			<input type="text" id="Nom" name="Nom">
			<br><br>
			<input type="submit" value="Ajouter"></button>
			<br><br>
		</form>
		<?php include('insert_bloctab.php'); ?>
	</body>
</html>