<?php
	session_start(); 
	$q = utf8_decode($_REQUEST["q"]);
	include('connexion_bdd.php');
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
	$monfichier = fopen('resultat_bloc.txt', 'w');

	$retour=$connexion->query("SELECT id_bloc,Nom FROM competence_bloc WHERE id_formation=".$q);
	

	fputs($monfichier, "\n");
	while ($donnees=$retour->fetch())      // Lecture ligne par ligne de la r걯nse  
	{
		fputs($monfichier, "\n".utf8_encode($donnees['id_bloc']));
		fputs($monfichier, "\n".utf8_encode($donnees['Nom']));
	}
	fclose($monfichier);
?>