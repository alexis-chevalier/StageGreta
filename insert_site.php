<?php
include('./test_connecter.php');
include('./header.php');
	
	if (isset($_POST["id_agence"]) && isset($_POST["Site"]) && isset($_POST["CP"]) && isset($_POST["Adresse"]) && isset($_POST["Telephone"]))
	{
		include('./connexion_bdd.php');
		
		$agence = $_POST["id_agence"];
		$Site = utf8_decode($_POST["Site"]);
		$CP = $_POST["CP"];
		$Adresse = utf8_decode($_POST["Adresse"]);
		$Telephone = $_POST["Telephone"];
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("INSERT INTO coordonnees_site(id_agence, Nom, Adresse, Code_Postal, Telephone) VALUES ( '".$agence."','".$Site."','".$Adresse."','".$CP."','".$Telephone."')"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		else{
			echo "Site ajouté";
		}
		$stmt->close();
	}
?>