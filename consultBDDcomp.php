<?php
	include('./test_connecter.php');
	include('./header.php');
            include('./connexion_bdd.php');
            $conn= mysqli_connect($host,$user,$password);
            mysqli_select_db($conn, "greta_formations");
            $sqlSelect = "SELECT * FROM formation_competences";
            $result = mysqli_query($conn, $sqlSelect);

            if (mysqli_num_rows($result) > 0) {
                ?>
            <table id='Table' border="1">
            <thead>
                <tr>
                    <th>Id bloc</th>
                    <th>Compétences</th>
                </tr>
            </thead>
<?php
                
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo utf8_encode ($row['id_bloc']); ?></td>
                    <td><?php  echo utf8_encode ($row['Competence']); ?></td>
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>