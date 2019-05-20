<head>
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/general.css">
</head>
<body>
<div id="header">
	<div id="deconnexion">
	<a href="./deconnexion.php">Se déconnecter</a>
	</div>
	<div id="menu">
	<img align=middle src="logo/LogoGEB_fond_transparent.png" id="logo"></img>
	<a href="./accueil.php">Accueil</a>
	<?php
		if($_SESSION["Admin"] && isset($_SESSION["Admin"])){
			echo "<a href='./gestion_compte.php'>Gestion des comptes</a>";
			echo "<a href='./log/log.txt'>Voir log</a>";
		}
	?>
	<a href="./page_formulaire_pdf.php">Attestation de compétences</a>
	<a href="./formulaireBDD.php">Importation de données</a>
	<a href="./consult_menu.php">Consulter BDD</a>
	</div>
</div>
</body>