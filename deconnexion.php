<?php
echo '<meta http-equiv="refresh" content="3;url=./page_connexion.php"/>';
if(!isset($_SESSION)) 
{ 
	session_start(); 
}
// date_default_timezone_set('Europe/Paris');
// $date = date('m/d/Y H:i:s', time());
		
// $monfichier = fopen('log/log.txt', 'a+');
// fputs($monfichier, "[".$date."] "."Déconnexion de ".$_SESSION["Mail"]." (".$_SERVER['REMOTE_ADDR'].").\n");
// fclose($monfichier);
$_SESSION = array();
session_destroy();
setcookie("mail", "", 1);
setcookie("pass_hache", "", 1);
echo "Déconnecter !<br>";
echo "Redirection vers la <a href='./page_connexion.php'>page de connexion</a> !";
?>