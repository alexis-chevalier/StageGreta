<?php
	include('./test_connecter.php');
	include('./header.php');
            include('./connexion_bdd.php');
            $conn= mysqli_connect($host,$user,$password);
            mysqli_select_db($conn, "greta_formations");
            $sqlSelect = "SELECT * FROM greta_agence";
            $result = mysqli_query($conn, $sqlSelect);

            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='Table' border="1">
            <thead>
                <tr>
                    <th>ID Agence</th>
                    <th>Agence</th>
                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
					<td><?php  echo utf8_encode ($row['id_agence']); ?></td>
                    <td><?php  echo utf8_encode ($row['Agence']); ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>