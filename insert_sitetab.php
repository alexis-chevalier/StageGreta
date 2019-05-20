<?php
	include('./test_connecter.php');
	include('./connexion_bdd.php');
	$conn= mysqli_connect($host,$user,$password);
	mysqli_select_db($conn, "greta_formations");

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into coordonnees_site (id_agence, Nom, Adresse, Code_Postal, Telephone)
                   values ('" . $column[0] . "','" . utf8_decode($column[1]) . "','" . utf8_decode($column[2]) . "','" . $column[3] . "','" . $column[4] . "')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "Le fichier CSV a bien été importer dans la base de données";
            } else {
                $type = "error";
                $message = "Problème avec l'importation du fichier CSV";
            }
        }
    }
}
?>
<html>
	<head>
		<script src="js/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="css/Style_Table.css">
		<script type="text/javascript">
			$(document).ready(function() {
				$("#frmCSVImport").on("submit", function () {

					$("#response").attr("class", "");
					$("#response").html("");
					var fileType = ".csv";
					var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
					if (!regex.test($("#file").val().toLowerCase())) {
						$("#response").addClass("error");
						$("#response").addClass("display-block");
						$("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
						return false;
					}
					return true;
				});
			});
		</script>
	</head>

<body>
    <h2>Importation de données via un Fichier CSV</h2>
    
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
		<?php if(!empty($message)) { echo $message; } ?>
	</div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Sélectionnez un fichier CSV :</label>
					<br><br>
					<input type="file" name="file" id="file" accept=".csv">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Importer</button>
                    <br />

                </div>

            </form>

        </div>
    </div>
</body>
</html>