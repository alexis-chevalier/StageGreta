<?php
	include('./test_connecter.php');
	include('./test_admin.php');
?>
<head>
	<title>Gestion des comptes</title>
</head>
<body>
	<?php include('./header.php'); ?>
	<div id="marge-rose">
	<div id="fond-blanc">
	<form name="formulaire" action="inscription.php" method="POST">
	<h1> Inscription </h1>
	<script type="text/javascript" src="js/inscription.js"></script>
	<label for="mail">Mail</label><br>
	<input type="text" id="mail" name="mail"></input>
	<br><br>
	<label for="pass">Mot de passe</label><br>
	<input type="password" id="pass" name="pass"></input>
	<br><br>
	<label for="conf_pass">Confirmer mot de passe</label><br>
	<input type="password" id="conf_pass" name="conf_pass"></input>
	<br><br>
	<label for="nom">Nom</label><br>
	<input type="text" id="nom" name="nom"></input>
	<br><br>
	<label for="prenom">Prénom</label><br>
	<input type="text" id="prenom" name="prenom"></input>
	<br><br>
	<label for="type_compte">Type de compte</label><br>
	<select id="type_compte" name="type_compte">
		<option value="admin">Administrateur</option>
		<option value="greta" selected>Greta</option>
	</select>
	<br><br>
	<input type="button" value="Inscrire" onclick="controller()"></button>
	</form>
	<br><br><br>
	<h1> Désinscription </h1>
	<form name="de_formulaire" action="desinscription.php" method="POST">
	<label for="mail">Mail</label><br>
	<input type="text" id="de_mail" name="de_mail"></input>
	<br><br>
	<input type="submit" value="Désinscrire"></button>
	</form>
	</div>
	</div>
</body>