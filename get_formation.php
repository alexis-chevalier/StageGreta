<?php
	session_start(); 
	$q = utf8_decode($_REQUEST["q"]);
	include('connexion_bdd.php');
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
	$monfichier = fopen('resultat_formation.txt', 'w');
	
	$retour=$connexion->query("SELECT Competence FROM formation_competences WHERE id_bloc=".$q);

	while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la rê±¯nse  
	{
		fputs($monfichier, "\n".utf8_encode($donnees['Competence']));
	}
	fclose($monfichier);
?>