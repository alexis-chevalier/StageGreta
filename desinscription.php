<?php 
	include('./test_connecter.php');
	include('./test_admin.php');
	include('./header.php');
	 
	if (isset($_POST["de_mail"]))
	{
		// Vérification de la validité des informations

		// Hachage du mot de passe
		include('./connexion_bdd.php');
		$mail = $_POST["de_mail"];
		
		$mysqli = new mysqli($host, $user, $password, $database);
		if ($mysqli->connect_errno) 
		{
			echo "Echec de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}

		if (!($stmt = $mysqli->prepare("DELETE FROM greta_user WHERE Mail='".$mail."'"))) 
		{
			echo "Echec lors de la préparation : (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->execute()) {
			echo "Echec lors de l'exécution de la requête : (" . $stmt->errno . ") " . $stmt->error;
		}
		$stmt->close();
		
		// date_default_timezone_set('Europe/Paris');
		// $date = date('m/d/Y H:i:s', time());
		
		// $monfichier = fopen('log/log.txt', 'a+');
		// fputs($monfichier, "[".$date."] ".$_SESSION["Mail"]." a supprimer l'utilisateur: ".$mail."\n");
		// fclose($monfichier);
		
		echo "Utilisateur supprimer !<br>";
	}
	else
	{
		echo "Le champ n'est pas remplie<br><br>";
	}
?>