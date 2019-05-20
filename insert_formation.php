<?php
include('./test_connecter.php');
include('./header.php');
	
	if (isset($_POST["Agence"]) && isset($_POST["Site"]) && isset($_POST["Titre"]) && isset($_POST["Objectif"]) && isset($_POST["Certification"]) && isset($_POST["Niveau"]))
	{
		include('./connexion_bdd.php');
		
		$Agence = $_POST["Agence"];
		$Site = $_POST["Site"];
		$Titre = $_POST["Titre"];
		$Objectif = $_POST["Objectif"];
		$Certification = $_POST["Certification"];
		$Niveau = $_POST["Niveau"];
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("INSERT INTO liste_formation(id_formation, Agence, Site, Titre, Objectif, Certification, Niveau) VALUES ( 0 ,'".utf8_decode($_POST["Agence"])."','".utf8_decode($_POST["Site"])."','".utf8_decode($_POST["Titre"])."','".utf8_decode($_POST["Objectif"])."','".utf8_decode($_POST["Certification"])."','".$_POST["Niveau"]."')"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		else{
			echo "Formation ajoutée";
		}
		$stmt->close();
	}
?>