<?php
include('./test_connecter.php');
include('./header.php');
	
	
		include('./connexion_bdd.php');
		
		$bloc = $_POST["Bloc"];
		$Competence = $_POST["Competence"];
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno)
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("INSERT INTO formation_competences(id_bloc, Competence) VALUES ( ".$bloc.",'".$Competence."')"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		else{
			echo "Compétence ajoutée";
		}
		$stmt->close();
?>