<?php
    include('menu.php');
    include('header.php');
    
    echo '<div class="divstandard"><form method="POST" action="">
        <div class="form-row align-items-center ">
            <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Name</label>
            <input type="text" class="form-control mb-2" id="inlineFormInput" name="nomCat" placeholder="Nome catégorie">
            </div>
            <div class="col-auto">
                <button type="submit" name="addCategrie" class="btn btn-info btn-lg">ajouter</button>
            </div>
        </div>
    </form></div>';

    // Create connection
    $conn = new mysqli("localhost", "root", "", "vente");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Categorie  ORDER BY `categorie`.`idCategorie` ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo '<div class=" align-items-center divstandard">
        <table class="table table-striped ">
            <thead>
            <tr>
                <th scope="col">id catégorie</th>
                <th scope="col">nom catégorie</th>
            </tr>
            </thead>
            <tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>
                    <th scope="row">'. $row["idCategorie"].'</th>
                    <td>'. $row["nomCategorie"].'</td>
                </tr>';
        }
        echo "</tbody>
        </table></div>";
    } 
    else {
    echo '<p class="text-center font-weight-bolder">Aucun catégorie</p>';
    }
    $conn->close();
    include('footer.php');

    if(isset($_POST['addCategrie']))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nomCat=$_POST['nomCat'];
        $sql = "select nomCategorie from Categorie where nomCategorie='".$nomCat."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<script>alert(\"nom de catégorie est deja exist\")</script>";
            $conn->close();
        }
        else
        {
            $conn->close();
            $conn = new mysqli("localhost", "root", "", "vente");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "INSERT INTO Categorie (nomCategorie)VALUES ('".$nomCat."')";

            if ($conn->query($sql) === TRUE) {
            echo "<script>alert(\"ajouter catégorie terminer avec succès\")</script>";
            } else {
            echo "Error";
            }
            $conn->close();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
?>