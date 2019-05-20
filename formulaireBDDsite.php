<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
?>

<html>
		<head>
			<title>Insertion d'un site</title>
			<link rel="stylesheet" href="css/formulaire.css">
			<link rel="stylesheet" href="css/header.css">
	</head>
	<body>
		<?php include('./header.php'); ?>
		<br><br>
		<h1>Insertion d'un site</h1>
		<br>
		<form name="formulaire" action="insert_site.php" method="POST">
			<label for="id_agence">Agence</label><br>
			<select id="id_agence" name="id_agence" selected="1">
				<option value="0">-----------------------------</option>
				<?php
					$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
					$retour=$connexion->query("SELECT DISTINCT id_agence,Agence FROM greta_agence");
			
					while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
					{
						echo '<option value="';
						echo utf8_encode($donnees['id_agence']);
						echo '">';
						echo utf8_encode($donnees['Agence']);
						echo '</option>';
					}
				?>
			</select>
			<br><br>
			Nom<br>
			<input type="text" id="Site" name="Site">
			<br><br>
			Code postal<br>
			<input type="text" id="CP" name="CP">
			<br><br>
			Adresse<br>
			<input type="text" id="Adresse" name="Adresse">
			<br><br>
			Téléphone<br>
			<input type="text" id="Telephone" name="Telephone">
			<br><br>
			<input type="submit" value="Ajouter"></button>
			<br><br>
		</form>
		<?php include('insert_sitetab.php'); ?>
	</body>
</html>