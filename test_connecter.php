<?php
	if(!isset($_SESSION)) 
	{ 
		session_start(); 
	}
	if (!(isset($_SESSION["Admin"])))
	{
		echo "Vous devez être connecté pour faire cela !<br>";
		echo "Redirection automatique vers la <a href='./page_connexion.php'>page de connexion</a>";
		echo '<script>window.location.replace("./page_connexion.php");</script>';
		exit();
	}
?>