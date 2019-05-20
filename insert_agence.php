<?php
include('./test_connecter.php');
include('./header.php');
	if (isset($_POST["agence"]))
	{
		include('./connexion_bdd.php');
		$agence = utf8_decode($_POST["agence"]);
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("INSERT INTO greta_agence(Agence) VALUES ( '".$agence."')"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		else{
			echo "Agence ajoutée";
		}
		$stmt->close();
	}
?>