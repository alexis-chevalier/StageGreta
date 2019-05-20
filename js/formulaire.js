var a = 0; //C'est pour la vérification de ajoutSite
var b = 0;

function sleep(milliseconds) { //Besoin de cette fonction sinon le fichier est entrain d'être écrit alors qu'on a besoin de lire dedans
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function envoieRequeteFormation(){
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			this.responseText = document.getElementById("agence").value ;
		}
    };
    xmlhttp.open("GET", "get_bloc.php?q=" + document.getElementById("formation").value, true);
    xmlhttp.send();
	sleep(200);
	// if ($('#checkbox_competence').length){
        // $("#checkbox_competence").empty();
    // }
	var s= document.getElementById('type_bloc');
	$.get('resultat_bloc.txt', function(result) {
		$('#type_bloc').find('option').remove().end();
		if (result == 'ON') {
			// alert('ON');
		} else if (result == 'OFF') {
			// alert('OFF');
		} else {
			var lines = result.split('\n');
			for(var line = 0; line < lines.length; line=line+2){
				s.options[s.options.length]= new Option(lines[line+1], lines[line]);
			}
		}
	});
}

function listeCheckbox(){
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			this.responseText = document.getElementById("type_bloc").value;
		}
    };
    xmlhttp.open("GET", "get_formation.php?q=" + document.getElementById("type_bloc").value, true);
    xmlhttp.send();
	sleep(200);
	$.get('resultat_formation.txt', function(result) {
		if (result == 'ON') {
			// alert('ON');
		} else if (result == 'OFF') {
			// alert('OFF');
		} else {
			var lines = result.split('\n');
			var table = $('<table border="1" align="center">');
			var row = $('<th>').html('<input class='+$("#type_bloc option:selected").text()+' onchange="ToutSelectionner(this)" type="checkbox" value="'+$("#type_bloc option:selected").text()+'" />'+$("#type_bloc option:selected").text());
			table.append(row);
			for(var line = 0; line < lines.length; line++){
				if (lines[line] != ""){
				var row = $('<tr>').html('<input class="'+$("#type_bloc option:selected").text()+"option"+'" type="checkbox" name="competence[]" value="'+lines[line]+'" />'+lines[line]);
				table.append(row);
				}
			}
			$('#checkbox_competence').append(table);
		}
	});
}

function ToutSelectionner(element){
	if (element.checked) {
		nom_class = element.className;
		$("."+nom_class+"option").prop("checked", "true");
	}
}

function envoieRequeteAgence() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			this.responseText = document.getElementById("agence").value ;
		}
    };
    xmlhttp.open("GET", "get_agence.php?q=" + document.getElementById("agence").value, true);
    xmlhttp.send();
	sleep(100);
	var s= document.getElementById('site');
	$.get('resultat_agence.txt', function(result) {
		$('#site').find('option').remove().end();
		if (result == 'ON') {
			// alert('ON');
		} else if (result == 'OFF') {
			// alert('OFF');
		} else {
			var lines = result.split('\n');
			for(var line = 0; line < lines.length; line++){
				s.options[s.options.length]= new Option(lines[line], lines[line]);
			}
		}
	});
}

function envoieRequeteSite() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        this.responseText = document.getElementById("site").value ;
        }
    };
    xmlhttp.open("GET", "get_site.php?q=" + document.getElementById("site").value, true);
    xmlhttp.send();
	sleep(100);
	var s= document.getElementById('formation');
	$.get('resultat_site.txt', function(result) {
		$('#formation').find('option').remove().end();
		if (result == 'ON') {
			// alert('ON');
		} else if (result == 'OFF') {
			// alert('OFF');
		} else {
			var lines = result.split('\n');
			for(var line = 0; line < lines.length; line=line+2){
				s.options[s.options.length]= new Option(decodeURI(lines[line+1]), decodeURI(lines[line]));
			}
		}
	});
}
   
function obtenirDate(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1;

	var yyyy = today.getFullYear();
	if (dd < 10) {
		dd = '0' + dd;
	} 
	if (mm < 10) {
		mm = '0' + mm;
	} 
	var today = yyyy + '-' + mm + '-' + dd;
	document.getElementById('date').value = today;
}

function controller(){
	if(document.getElementById("site").value == '')
    {
		 alert("Vous devez selectionné un site!");
		 return false;
    }
	if(document.getElementById("formation") == '')
    {
		alert("Vous devez selectionné une formation!");
		return false;
    }
	if(document.getElementById("debut_formation") == null || document.getElementById("debut_formation").value == ''){
		alert("Vous devez mettre une date de début !");
		return false;
	}
	if(document.getElementById("fin_formation") == null || document.getElementById("fin_formation").value == ''){
		alert("Vous devez mettre une date de fin !");
		return false;
	}
	if(document.getElementById("nom_stagiaire").value == '')
    {
		alert("Vous devez specifier le nom du stagiaire!");
		return false;
    }
	
	if(document.getElementById("prenom_stagiaire").value == '')
    {
		alert("Vous devez specifier le prenom du stagiaire!");
		return false;
    }
	  
	if(document.getElementById("resp").value == '')
	{
		alert("Vous devez specifier un responsable pédagogique !");
		return false;
	}
	document.formulaire.method ="get";
    document.formulaire.action = "creer_pdf.php";
	document.formulaire.submit();
	return true;
}