<?php
    include('menu.php');
    include('header.php');
    echo '<form method="POST" action="" enctype="multipart/form-data"><div class="divstandard">
    <script language="JavaScript">
      function showPreview(ele)
      {
          $("#imgAvatar").attr("src", ele.value); // for IE
                if (ele.files && ele.files[0]) {
          
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $("#imgAvatar").attr("src", e.target.result);
                    }

                    reader.readAsDataURL(ele.files[0]);
                }
      }
    </script>
    <div class="divstandard">
      <input type="file" name="imageProd" accept="image/*" OnChange="showPreview(this)" required>
      <hr>
      <img id="imgAvatar" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Nom Produit</label>
        <input type="text" class="form-control" name="nomProduit" required>
      </div>
      <div class="form-group col-md-6">
        <label>Prix en Dh</label>
        <input type="number" min="0.01" class="form-control" name="prix" step="0.01" required>
      </div>
    </div>
    <div class="form-group">
      <label>quantité en stock</label>
      <input type="number" min="0" class="form-control" name="qteStock" required>
    </div>
    <div class="form-row">
      <div class="form-group col-md-3">
        <label>Produit dans panier standard</label>
        <input class="form-control" type="checkbox" name="panierStandard">
      </div>
      <div class="form-group col-md-4">
        <label>Quantité dans panier standard</label>
        <input type="number" min="0" class="form-control" name="quantitepanier" required>
      </div>
      <div class="form-group col-md-5">
        <label>Catégorie</label>
        <select class="form-control" name="categorieselect">
          ';
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Categorie  ORDER BY `categorie`.`idCategorie` ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<option value="'. $row["idCategorie"].'">'. $row["nomCategorie"].'</option>';
            }
        } 
        else {
        echo '<option>voulez vous ajouter les catégories</option>';
        }
        $conn->close();
        echo '</select>
      </div>
    </div>
        <button type="submit" class="btn btn-info btn-lg" name="addProduit">ajouter</button>
    </div>
  </form>';
  include('footer.php');
  if(isset($_POST['addProduit']))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nomProd=$_POST['nomProduit'];
        $sql = "select nomProduit from Produit where nomProduit='".$nomProd."'";
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
            $idCat=$_POST['categorieselect'];
            $prix=$_POST['prix'];
            $qteStock=$_POST['qteStock'];
            $imageProduit=addslashes(file_get_contents($_FILES['imageProd']['tmp_name']));
            $panierStandard=0;
            if(isset($_POST['panierStandard'])){
              $panierStandard=1;
            }
            $quantitepanier=$_POST['quantitepanier'];
            $sql = "INSERT INTO Produit (idCategorie,nomProduit,prix,quantiteStock,imageProduit,produtit_panier_standard,qte_ligne_panier_standard)VALUES ($idCat,'$nomProd',$prix,$qteStock,'$imageProduit',$panierStandard,$quantitepanier)";

            if ($conn->query($sql) === TRUE) {
            echo "<script>alert(\"ajouter produit terminer avec succès\")</script>";
            } else {
            echo "Error: ";
            }
            $conn->close();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
?>