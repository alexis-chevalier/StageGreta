<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
?>

<html>
	<body>
		<head>
			<title>Insertion d'une formation</title>
			<link rel="stylesheet" href="css/formulaire.css">
			<link rel="stylesheet" href="css/Style_Table.css">
			<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="js/formulaireBDDformation.js"></script>
		</head>
			<?php include('./header.php'); ?>
			<br><br>
			<h1>Insertion d'une formation</h1>
			<br>
		<form name="formulaire" action="insert_formation.php" method="POST">	
			<label for="Agence">Agence</label><br>
			<select id="Agence" name="Agence" onchange="filtreSite()">
				<option value="0"></option>
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
			Site
			<br>
			<select id="Site" name="Site" selected="1">
				<option value="0"></option>
			</select>
			<br><br>
			Titre de formations<br>
			<input type="text" id="Titre" name="Titre" style="width:500px">
			<br><br>
			Objectif de formation<br>
			<input type="text" id="Objectif" name="Objectif" style="width:1000px">
			<br><br>
			Certification<br>
			<select id="Certification" name="Certification" selected="1">
				<option value="1">----------------------------------------------------</option>
				<option value="BTS">BTS</option>
                <option value="Bac. Pro.">Baccalauréat Professionnel</option>
                <option value="Titre Professionnel">Titre Professionnel</option>
                <option value="Certificat">Certificat</option>
                <option value="CAP">CAP</option>
                <option value="CQP">Certificat de Qualification Professionnel</option>
                <option value="Mention Complémentaire">Mention Complémentaire</option>
                <option value="Titre">Titre</option>
			</select>
			<br><br>
			Niveau
			<br>
			<select id="Niveau" name="Niveau" selected="0">
				<option value="0">----------</option>
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="IV">IV</option>
				<option value="V">V</option>
			</select>
			<br><br>
			<input type="submit" value="Ajouter"></button>
		</form>
		<?php include('insert_formtab.php'); ?>
	</body>
</html>	