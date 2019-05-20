<?php
	if(!($_SESSION["Admin"]) && isset($_SESSION["Admin"]))
	{
		echo "<body>";
		echo "<p>Erreur droit incorrect</p><br><br>";
		echo "<a href='./accueil.php'>Accueil</a>";
		echo "</body>";
		exit();
	}
?>