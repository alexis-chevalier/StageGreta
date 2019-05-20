<?php
	include('./test_connecter.php');
	include('./header.php');
            include('./connexion_bdd.php');
            $conn= mysqli_connect($host,$user,$password);
            mysqli_select_db($conn, "greta_formations");
            $sqlSelect = "SELECT * FROM coordonnees_site";
            $result = mysqli_query($conn, $sqlSelect);

            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='Table' border="1">
            <thead>
                <tr>
                    <th>Agence</th>
                    <th>Nom de l'établissement</th>
					<th>Code Postal</th>
					<th>Adresse</th>
					<th>Téléphone</th>
                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo utf8_encode ($row['id_agence']); ?></td>
                    <td><?php  echo utf8_encode ($row['Nom']); ?></td>
					<td><?php  echo utf8_encode ($row['Code_Postal']); ?></td>
					<td><?php  echo utf8_encode ($row['Adresse']); ?></td>
					<td><?php  echo utf8_encode ($row['Telephone']); ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>