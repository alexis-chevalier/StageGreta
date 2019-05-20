<?php 

if (isset($_COOKIE["mail"]) && isset($_COOKIE["pass_hache"])){
	$host="localhost";
	$user="root";
	$password="";
	$database="greta_formations";
	$bdd = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password);
	
	//  Récupération de l'utilisateur et de son pass hashé
	//Ne pas oublier d'ajouter le type_profil
	$req = $bdd->prepare('SELECT id_user,Password,Nom,Prenom,Admin FROM greta_user WHERE mail = :mail');
	$req->execute(array(
		'mail' => $_COOKIE["mail"]));
	$resultat = $req->fetch();
	
	$isPasswordCorrect = password_verify($_COOKIE["pass_hache"], $resultat['Password']);

	if (!$resultat)
	{
		echo 'window.location.replace("./page_connexion.php");';
	}
	else
	{
		if ($isPasswordCorrect) 
		{
			echo '<script>window.location.replace("./connexion.php");</script>';
		}
		else 
		{
			echo 'Mauvais identifiant ou mot de passe !';
			echo '<script>window.location.replace("./page_connexion.php");</script>';
		}
	}
}
?>