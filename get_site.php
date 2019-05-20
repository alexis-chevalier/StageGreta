<?php
	session_start(); 
	$q = utf8_decode($_REQUEST["q"]);
	include('connexion_bdd.php');
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
	$monfichier = fopen('resultat_site.txt', 'w');

	// $q = "Lycée Maupertuis";

	$retour=$connexion->query("SELECT id_formation,Titre FROM liste_formation WHERE Site='".$q."'");

	fputs($monfichier, "\n");
	while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la rê±¯nse  
	{
		fputs($monfichier, "\n".utf8_encode($donnees['id_formation']));
		fputs($monfichier, "\n".utf8_encode($donnees['Titre']));
	}
	fclose($monfichier);
?>