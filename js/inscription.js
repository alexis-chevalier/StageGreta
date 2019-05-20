function controller(){
	  if(document.getElementById("pass").value != document.getElementById("conf_pass").value)
      {
		 alert("Mauvais mot de passe!");
		 return false;
      }
	  soumettre();
	  return true;
}

function soumettre(){
    document.formulaire.method ="post";
    document.formulaire.action = "inscription.php";
	document.formulaire.submit();
}