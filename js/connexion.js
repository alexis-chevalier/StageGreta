function controller(){
	 if (!validermail())
      {
		 alert("Mail incorrect !");
		 return false;
      }
	  if(document.getElementById("pass").value == '')
      {
		 alert("Vous avez omis le mot de passe");
		 return false;
      }
	  soumettre();
	  return true;
}

function validermail() {
	email= document.getElementById("mail").value;
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function soumettre(){
    document.formulaire.method ="post";
    document.formulaire.action = "connexion.php";
	document.formulaire.submit();
}