<?php 
	include('./connexion_bdd.php');
	if (isset($_COOKIE["mail"]) && isset($_COOKIE["pass_hache"])){
		$mail = $_COOKIE["mail"];
		$pass = $_COOKIE["pass_hache"];
	}
	else{
		$mail=$_POST["mail"];
		$pass=$_POST["pass"];
	}
	
	$bdd = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password);

	//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id_user,Password,Nom,Prenom,Admin FROM greta_user WHERE mail = :mail');
	$req->execute(array(
		'mail' => $mail));
	$resultat = $req->fetch();

	// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify($pass, $resultat['Password']);

	if (!$resultat)
	{
		echo '<script>alert("Mauvais identifiant ou mot de passe !");</script>';
		echo '<script>window.location.replace("./page_connexion.php");</script>';
		exit();
	}
	else
	{
		if ($isPasswordCorrect) {
			session_start();
			$_SESSION['id_user'] = $resultat['id_user'];
			$_SESSION['Mail'] = $mail;
			$_SESSION['Nom'] = $resultat['Nom'];
			$_SESSION['Prenom'] = $resultat['Prenom'];
			$_SESSION['Admin'] = $resultat['Admin'];
			setcookie('mail', $mail);
			setcookie('pass_hache', $pass);
			date_default_timezone_set('Europe/Paris');
			$date = date('m/d/Y H:i:s', time());
		
			$monfichier = fopen('log/log.txt', 'a+');
			fputs($monfichier, "[".$date."] Connexion de ".$_SESSION["Mail"]." (".$_SERVER['REMOTE_ADDR'].").\n");
			fclose($monfichier);
			echo '<script>window.location.replace("./accueil.php");</script>';
		}
		else
		{
			echo '<script>alert("Mauvais identifiant ou mot de passe !");</script>';
			echo '<script>window.location.replace("./page_connexion.php");</script>';
			exit();
		}
	}
?>