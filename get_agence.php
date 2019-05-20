<?php
	session_start(); 
	$q = utf8_decode($_REQUEST["q"]);
	include('connexion_bdd.php');
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
	$monfichier = fopen('resultat_agence.txt', 'w');

	//$_SESSION['Agence']=$q;

	$retour=$connexion->query("SELECT Nom FROM coordonnees_site WHERE id_agence=".$q);


	while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
	{
		fputs($monfichier, "\n".utf8_encode($donnees['Nom']));
	}
	fclose($monfichier);
?>