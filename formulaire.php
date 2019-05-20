<?php
	include('./test_connecter.php');
	if (isset($_GET["agence"]) && isset($_GET["site"]) && isset($_GET["site"]) && isset($_GET["formation"]) && isset($_GET["stagiaire"]) && isset($_GET["lieu"]) && isset($_GET["date"]) && isset($_GET["resp"])){
		echo "Informations: <br>";
		echo "Agence:  ".$_GET["agence"]." <br>";
		echo "Site: ".$_GET["site"]."<br>";
		echo "Formation: ".$_GET["formation"]."<br>";
		echo "Stagiaire: ".$_GET["stagiaire"]."<br>";
		echo "Competence: ";
		foreach ($_GET["competence"] as $i => $value) {
			echo $value;
			if ($i != count($_GET["competence"])-1){
				echo ",";
			}
			else{
				echo "<br>";
			}
		}
		echo "Lieu: ".$_GET["lieu"]." <br>";
		echo "Date: ".$_GET["date"]." <br>";
		echo "Responsable: ".$_GET["resp"]." <br>";
		echo "Type imprimé: ".$_GET["type_imp"]."<br>";
	}
	else{
		echo "Il manque un/des champ(s)";
	}
		echo "<br><br><a href='./accueil.php'>Accueil</a> ";
		echo "<a href='./page_formulaire_pdf.php'>Formulaire</a>";
?>
