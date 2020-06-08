<?php
    include('menu.php');
    include('header.php');

    // Create connection
    $conn = new mysqli("localhost", "root", "", "vente");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $id=$_SESSION['Client'];
    $sql = "SELECT commande.idCommande,commande.dateCommande,commande.prixUT,commande.etat_commande,commande.telephone,commande.adresse FROM commande WHERE commande.idUser=$id ORDER BY commande.dateCommande ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo '<div class="divstandard"><table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id commande</th>
                <th scope="col">date commande</th>
                <th scope="col">prix</th>
                <th scope="col">état</th>
                <th scope="col">telephone</th>
                <th scope="col">adresse</th>
            </tr>
            </thead>
            <tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr data-href="detailCommande.php?id='.$row["idCommande"].'">
                    <form method="POST" action="">
                    <th scope="row" name="idproduit">'. $row["idCommande"].'</th>
                    <td>'. $row["dateCommande"].'</td>
                    <td>'. $row["prixUT"].'</td>
                    <td>'. $row["etat_commande"].'</td>
                    <td>'. $row["telephone"].'</td>
                    <td>'. $row["adresse"].'</td>
                    </form>
                </tr>';
        }
        echo "</tbody>
        </table></div>";
    } 
    else {
    echo "<div class='divstandard'><p class='text-center font-weight-bolder'>Aucun commande</p></div>";
    }
    $conn->close();
    include('footer.php');
    echo '<script>$("tr[data-href]").on("click", function() {
        document.location = $(this).data("href");
    });</script>';
?>