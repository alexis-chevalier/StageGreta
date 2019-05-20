function sleep(milliseconds) { //Besoin de cette fonction sinon le fichier est entrain d'être écrit alors qu'on a besoin de lire dedans
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function filtreSite() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			this.responseText = document.getElementById("Agence").value ;
		}
    };
    xmlhttp.open("GET", "get_agence.php?q=" + document.getElementById("Agence").value, true);
    xmlhttp.send();
	sleep(100);
	var s= document.getElementById('Site');
	$.get('resultat_agence.txt', function(result) {
		$('#Site').find('option').remove().end();
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