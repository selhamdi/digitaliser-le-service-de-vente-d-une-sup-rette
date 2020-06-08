<?php
    include('menu.php');
    include('header.php');

    // Create connection
    $conn = new mysqli("localhost", "root", "", "vente");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT commande.idCommande,users.nom,users.prenom,commande.dateCommande,commande.telephone,commande.adresse,commande.prixUT FROM commande,users WHERE commande.etat_commande='en attente' AND commande.is_standard=0 AND commande.idUser=users.idUser ORDER BY commande.dateCommande ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo '<div class="divstandard"><table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">id commande</th>
                <th scope="col">nom client</th>
                <th scope="col">prenom client</th>
                <th scope="col">date commande</th>
                <th scope="col">prix</th>
                <th scope="col">telephone</th>
                <th scope="col">adresse</th>
                <th scope="col">terminé</th>
                <th scope="col">refusé</th>
            </tr>
            </thead>
            <tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr data-href="detailCommande.php?id='.$row["idCommande"].'">
                    <form method="POST" action="">
                    <th scope="row" name="idproduit">'. $row["idCommande"].'</th>
                    <td>'. $row["nom"].'</td>
                    <td>'. $row["prenom"].'</td>
                    <td>'. $row["dateCommande"].'</td>
                    <td>'. $row["prixUT"].'</td>
                    <td>'. $row["telephone"].'</td>
                    <td>'. $row["adresse"].'</td>
                    <td><button type="submit" class="btn btn-info btn-lg" name="termine['. $row["idCommande"].']">terminé</button></td>
                    <td><button type="submit" class="btn btn-info btn-lg" name="refuse['. $row["idCommande"].']">refusé</button></td>
                    </form>
                </tr>';
        }
        echo "</tbody>
        </table></div>";
    } 
    else {
        echo '<div class="divstandard"><p class="text-center font-weight-bolder">Aucun commande</p></div>';
    }
    $conn->close();
    include('footer.php');
    echo '<script>$("tr[data-href]").on("click", function() {
        document.location = $(this).data("href");
    });</script>';
    if(isset($_POST['termine']))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $id=array_keys($_POST["termine"])[0];
        $sql = "UPDATE commande SET etat_commande='termine' WHERE idCommande=$id";
        if (!$conn->query($sql) === TRUE) {
            echo "<script>alert(\"erreur\")</script>";
        }
        $conn->close();
        echo '<script>javascript:history.go(-1);</script>';
    }
    if(isset($_POST['refuse']))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $id=array_keys($_POST["refuse"])[0];
        $sql = "UPDATE commande SET etat_commande='refuse' WHERE idCommande=$id";
        if (!$conn->query($sql) === TRUE) {
            echo "<script>alert(\"erreur\")</script>";
        }
        $conn->close();
        echo '<script>javascript:history.go(-1);</script>';
    }
?>