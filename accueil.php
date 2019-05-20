<?php
	include('./test_connecter.php');
?>
<html>
	<head>
		<title>Accueil</title>
		
	</head>
	<body>
		<?php
		if(!isset($_SESSION)) 
		{ 
        session_start(); 
		}
		include('./header.php');
		echo "<div id='pdf'>";
		echo "Bonjour ".$_SESSION["Nom"]." ".$_SESSION["Prenom"];
		echo '<br><br><embed align="center" src= "doc/Tuto_Importation_de_donnees.pdf" width= "1000" height= "750">';
		echo "</div>";
		?>
	</body>
</html>