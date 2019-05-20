<?php
	include('./test_connecter.php');
	require('fpdf.php');
	header('Content-Type: text/html; charset=UTF-8'); //Sinon l'apostrophe "'" apparaît comme un "?"
	
	//log
	// date_default_timezone_set('Europe/Paris');
	// $date = date('m/d/Y H:i:s', time());
	// $monfichier = fopen('log/log.txt', 'a+');
	// fputs($monfichier, "[".$date."] ".$_SESSION["Mail"]." a creer un pdf pour : ".$_GET["nom_stagiaire"]." ".$_GET["prenom_stagiaire"].".\n");
	// fclose($monfichier);
	
	include('connexion_bdd.php');
	
	class PDF extends FPDF
	{
		// En-tête
		function Header()
		{
			// Logo
			$this->Image('logo/greta.png',10,6,30);
			//Saut de ligne
			$this->Ln(20);
		}

		// Pied de page
		function Footer()
		{
			// Positionnement à 1,5 cm du bas
			$this->SetY(-15);
			$this->SetFont('Times','',9);
			$this->Cell(0,10,'GRETA EST BRETAGNE ',0,0,'L');
			$this->Ln(5);
			// $this->Cell(0,10,utf8_decode("Document remis au bénéficiaire avec l'attestation administrative en fin de formation"),0,1,'R'); 
			if ($_GET["type_imp"] == "IMP01"){
				$vc_va="VC";
			}
			else{
				$vc_va="VA";
			}
			$this->Cell(0,10,utf8_decode("P05/MDF03/".$_GET["type_imp"]."/".$vc_va."/27/06/2018"),0,1,'R'); 
		}
	}

	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',20);
	
    // Encadré en haut de la page
	$espace=0;
	$pdf->SetXY(10, 30);
	$mem_y=$pdf->GetY();
	$pdf->SetFont('Arial','B',20);
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
	
	$retour=$connexion->query("SELECT Certification FROM liste_formation WHERE id_formation=".$_GET["formation"]);
	while ($donnees=$retour->fetch()){
		$certification = utf8_decode($donnees["Certification"]);
	}
	
	$pdf->MultiCell(0,10,"Attestation des acquis en fin de formation pour le ".$certification,0,'C',false);	
	$pdf->SetXY(10,$pdf->GetY());
	$pdf->SetFont('Arial','',16);
	$connexion = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);

	$retour=$connexion->query("SELECT Titre FROM liste_formation WHERE id_formation=".$_GET["formation"]);
	while ($donnees=$retour->fetch()){
		$formation = utf8_decode($donnees["Titre"]);
	}
	if ($_GET["type_imp"] != "IMP03"){
		$retour=$connexion->query("SELECT Niveau FROM liste_formation WHERE id_formation=".$_GET["formation"]);
		while ($donnees=$retour->fetch()){
			$niveau = utf8_decode($donnees["Niveau"]);
		}
	}
	if ($_GET["type_imp"] == "IMP03"){
		$pdf->MultiCell(0,10,$formation,0,'C',false);
	}
	else{
		$pdf->MultiCell(0,10,$formation." (Niveau ".$niveau.")",0,'C',false);
	}
	$pdf->SetXY(50,$pdf->GetY());
	$pdf->SetFont('Arial','',13);
	$pdf->Write(10,utf8_decode('Formation réalisée du '.$_GET["debut_formation"].' au '.$_GET["fin_formation"]));
	$autre_y = $pdf->GetY();
	$espace = $autre_y-$mem_y+10;
	$pdf->SetXY(10,$mem_y);
	$pdf->MultiCell(0,$espace,"",1,'C');
	$pdf->Ln(5);
	
	//Nom et prenom
	$pdf->SetFont('Arial','',14);
	$pdf->setXY($pdf->GetX()+15,$pdf->GetY());
	$pdf->Write(10,"Nom: ".$_GET["nom_stagiaire"]);
	$pdf->setXY($pdf->GetX()+25,$pdf->GetY());
	$pdf->Write(10,"Prenom: ".$_GET["prenom_stagiaire"]);
	
	//Objectifs
	$pdf->SetFont('Arial','U',14);
	$pdf->setXY(25,$pdf->GetY()+10);
	$pdf->Write(10,"Objectifs de la formation :");
	$pdf->SetFont('Arial','',13);
	$pdf->setXY(25,$pdf->GetY()+10);	

	$retour=$connexion->query("SELECT Objectif FROM liste_formation WHERE Titre='".$formation."'");
	while ($donnees=$retour->fetch()){
		$pdf->Write(10, utf8_encode($donnees['Objectif']));
	}
	
	$pdf->Ln(15);
	
	//Compétences
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,7,utf8_decode('Compétences Acquises '),1,0,'C');
	$pdf->Ln(0);
	$mem_x=$pdf->GetX();
	$mem_y=$pdf->GetY();
	$espace = 0;
	$pdf->setXY(15,$pdf->GetY()+10);
	
	$pdf->SetFont('Arial','',13);
	$pdf->Write(10,utf8_decode("Le bénéficiaire est capable de : "));
	$espace = $espace + 10;
	$pdf->setXY(25,$pdf->GetY()+10);
	$espace = $espace + 20;
	$donnees = "\n";
	foreach ($_GET["competence"] as $i => $value) {
			$donnees = $donnees."\n"."     - ".$value;
			$espace = $espace + 5;
	}
	$pdf->SetXY($mem_x,$mem_y);
	$pdf->SetFont('Arial','I',13);
	$pdf->MultiCell(0,10,utf8_decode($donnees),1,'J',false);
	
	
	//Fin du document (date, lieu, signature)
	$pdf->Ln(20);
	$pdf->SetFont('Times','',12);
	$pdf->setXY(25,$pdf->GetY()+5);
	$pdf->Write(5,utf8_decode("Fait à, ".$_GET["lieu"]."\n\n"));
	$pdf->SetX(25,$pdf->GetY()+5);
	$pdf->Write(5,"Le ".$_GET["date"]);
	$pdf->SetX($pdf->GetX()+60);
	$x_resp=$pdf->GetX()+10; //Garde la position en X du texte ci dessous pour mettre le nom du responsable en dessous
	$pdf->Write(10,utf8_decode("Signature du référent pédagogique"));
	$pdf->SetY($pdf->GetY()+15); //Décalage léger du nom du responsable vers la droite
	$pdf->SetX($x_resp);
	$pdf->Write(5,utf8_decode($_GET["resp"]));
$pdf->Output();
?>