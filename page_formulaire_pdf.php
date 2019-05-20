<?php
	include('./test_connecter.php');
?>


<html>
	<head>
		<title>Formulaire</title>
		<script type="text/javascript" src="js/formulaire.js"></script>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="css/formulaire.css">
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<?php header('Content-Type: text/html; charset=UTF-8'); ?>
	</head>
	<body>
		<?php include('./header.php'); ?>
		<div id="marge-rose">
		<div id="fond-blanc">
		<form name="formulaire" action="creer_pdf.php" method="GET">
		<h1> Formulaire </h1>
		<label for="agence">Agence</label><br>
		<select id="agence" name="agence" onchange="envoieRequeteAgence()">
		<?php
			include('./connexion_bdd.php');
			$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
			$retour=$connexion->query("SELECT DISTINCT id_agence,Agence FROM greta_agence ORDER BY Agence ASC");
			echo "<option value=''";
			echo " selected='selected' >---------------</option>";
			while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
			{
				echo "<option ";
				echo 'value="';
				echo utf8_encode($donnees['id_agence']);
				echo '">';
				echo utf8_encode($donnees['Agence']);
				echo '</option>';
			}
		?>
		</select>
		<br><br> 
		<label for="site">Site</label><br>
		<select id="site" name="site" onchange="envoieRequeteSite()">
		</select>
		<br><br>
		<label for="formation">Formation</label><br>
		<select id="formation" name="formation" onchange="envoieRequeteFormation()">
		</select>
		<br><br>
		<label for="debut_formation">Date début de la formation</label>
		<input type="date" id="debut_formation" name="debut_formation">
		<br><br>
		<label for="fin_formation">Date fin de la formation</label>
		<input type="date" id="fin_formation" name="fin_formation">
		<br><br>
		<label for="nom_stagiaire">Nom Stagiaire</label><br>
		<input type="text" id="nom_stagiaire" name="nom_stagiaire" >
		<br><br>
		<label for="prenom_stagiaire">Prenom Stagiaire</label><br>
		<input type="text" id="prenom_stagiaire" name="prenom_stagiaire" >				
					<br><legend>Compétence</legend>
					<div id="liste_bloc">
					<select id="type_bloc" name="type_bloc" onchange="listeCheckbox()">
					</select></div><br>
					<div id="checkbox_competence">
				</div>
		<label for="lieu">Lieu</label><br>
		<input type="text" id="lieu" name="lieu" ><br><br>
		<label for="date">Date</label><br>
		<input type="date" name="date" id="date">
		<script>
			obtenirDate();
		</script>
		<br><br>
		<label for="resp">Responsable pédagogique</label><br>
		<input type="text" id="resp" name="resp" ></select><br><br>
		<label for="type_imp">Type de l'imprimé</label><br>
		<select id="type_imp" name="type_imp">
			<option value="IMP01">IMP01 - Diplôme</option>
			<option value="IMP02">IMP02 - Titre pro.</option>
			<option value="IMP03">IMP03 - Autre </option>
		</select><br><br>
		<input type="button" value="Envoyer" onclick="controller()"></button><br>
		</form>
		</div>
		</div>
	</body>
</html>