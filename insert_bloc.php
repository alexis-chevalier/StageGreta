<?php
include('./test_connecter.php');
include('./header.php');
	
	if (isset($_POST["Nom"]))
	{
		include('./connexion_bdd.php');
		
		$Nom = utf8_decode($_POST["Nom"]);
		$id_formation = $_POST["formation"];
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("INSERT INTO competence_bloc(id_bloc,id_formation,Nom) VALUES ( 0,".$id_formation.",'".$Nom."')"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		else{
			echo "Bloc ajouté";
		}
		$stmt->close();
	}
?>