<?php
    include('menu.php');
    include('header.php');
    echo '<div class="divstandard">';
    if(isset($_GET["id"]) && !empty( $_GET['id'] ))
    {
        $id=$_GET["id"];
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT produit.nomProduit,produit.imageProduit,produit.prix from produit,lignecommande where lignecommande.idCommande=$id and lignecommande.idProduit=produit.idProduit ORDER BY produit.idProduit ASC";
        $result = mysqli_query($conn, $sql);  
                    
        if ($result->num_rows > 0) {
            echo '<div class="row">';
            while($row = mysqli_fetch_array($result))  
                    {  
                        echo '<div class="col-sm-4 cardProduit">
                        <div class="card">
                        <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />  
                        <div class="card-body">
                            <h5 class="card-title">'.$row['nomProduit'].'</h5>
                            <p class="card-text text-right">'.$row['prix'].' Dh</p>
                        </div>
                        </div>
                        </div>';  
                    }
            echo '</div>
            <a href="addProduit.php"><button type="button" class="btn btn-light btn-lg">Ajouter Produit</button></a>';
            
        } 
        else {
        echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
        }
        $conn->close();
        echo '</div>';
        include('footer.php');
    }
    else {
        echo '<div class="divstandard">
        <p class="text-center font-weight-bolder">Id de commande et invalide</p></div>';
    }
?>