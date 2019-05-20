<?php 

	include('./test_connecter.php');
	include('./header.php');
	
	if (isset($_POST["mail"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["type_compte"]))
	{
		// Vérification de la validité des informations

		// Hachage du mot de passe
		$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		include('./connexion_bdd.php');
		$mail = $_POST["mail"];
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$greta = 0;
		$type_compte = $_POST["type_compte"];

		if ($type_compte == "admin"){
			$admin = 1;
			$greta = 0;
		}
		elseif ($type_compte == "greta"){
			$admin = 0;
			$greta = 1;
		}
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		/* Requête préparée, étape 1 : la préparation */
		if (!($stmt = $mysqli->prepare("INSERT INTO greta_user(Mail,Password,Nom,Prenom,Admin,GRETA) VALUES ( '".$_POST["mail"]."','".$pass_hache."','".$nom."','".$prenom."',".$admin.","."$greta".")"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();

		date_default_timezone_set('Europe/Paris');
		$date = date('m/d/Y H:i:s', time());
		
		$monfichier = fopen('log/log.txt', 'a+');
		fputs($monfichier, "[".$date."] ".$_SESSION["Mail"]." a inscrit le nouvel utilisateur: ".$nom." ".$prenom." (".$mail.")."."\n");
		fclose($monfichier);
		
		echo "Nouvel inscrit: <br>";
		echo "Mail: ".$mail."<br>";
		echo "Nom: ".$nom."<br>";
		echo "Prenom: ".$prenom."<br>";
		echo "Administrateur: ";
		if ($admin)
		{
			echo "Oui";
		}
		else{
			echo "Non";
		}
		echo "<br>Greta: ";
		if ($greta)
		{
			echo "Oui";
		}
		else{
			echo "Non";
		}
	}
	else{
		echo "Il manque un/des champ(s)<br><br>";
		echo "<a href='./gestion_compte.php'>Gestion des comptes</a> ";
	}
?>