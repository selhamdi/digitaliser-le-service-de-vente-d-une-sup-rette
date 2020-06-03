<?php
    include('menu.php');
    include('header.php');
    if(isset($_GET["id"]) && !empty( $_GET['id'] ))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        $id=$_GET["id"];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM `produit` where idProduit=".$id;
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($rows = mysqli_fetch_array($result))  
            {  
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
                    <input type="file" name="imageProd" accept="image/*" OnChange="showPreview(this)">
                    <hr>
                    <img id="imgAvatar" src="data:image/jpeg;base64,'.base64_encode($rows['imageProduit'] ).'" class="rounded mx-auto d-block" style="width: 500px;height:300px;margin-bottom: 50px;">
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nom Produit</label>
                        <input type="text" class="form-control" name="nomProduit" required value="'.$rows["nomProduit"].'">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Prix en Dh</label>
                        <input type="number" min="0.01" class="form-control" name="prix" step="0.01" required value="'.$rows["prix"].'">
                    </div>
                    </div>
                    <div class="form-group">
                    <label>quantité en stock</label>
                    <input type="number" min="0" class="form-control" name="qteStock" required value="'.$rows["quantiteStock"].'">
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Produit dans panier standard</label>
                        <input class="form-control" type="checkbox" name="panierStandard" ';if($rows["produtit_panier_standard"]==1){echo "checked";}echo'>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Quantité dans panier standard</label>
                        <input type="number" min="0" class="form-control" name="quantitepanier" required value="'.$rows["qte_ligne_panier_standard"].'">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Catégorie</label>
                        <select class="form-control" name="categorieselect">
                        ';
                        $sql = "SELECT * FROM Categorie  ORDER BY `categorie`.`idCategorie` ASC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'. $row["idCategorie"].'"';if($rows["idCategorie"]==$row["idCategorie"]){echo 'selected="selected"';} echo'>'. $row["nomCategorie"].'</option>';
                            }
                        } 
                        else {
                        echo '<option>voulez vous ajouter les catégories</option>';
                        }
                        echo '</select>
                    </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-lg" name="updateProduit">Modifier</button>
                        <button type="submit" class="btn btn-danger btn-lg" name="deleteProduit">Supprimer</button>
                        <input type="button" value="Annuler" onClick="javascript:history.go(-1)" class="btn btn-info btn-lg"/>
                    </div>
                </form>';  
                }
        } 
        else {
            echo '<div class="divstandard">
            <p class="text-center font-weight-bolder">Id de produit et invalide</p></div>';
        }
        $conn->close();
    }
    else
    {
        echo '<div class="divstandard">
        <p class="text-center font-weight-bolder">Aucun produit sélectionné</p></div>';
    }
    include('footer.php');
    if(isset($_POST['updateProduit']))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $nomProd=$_POST['nomProduit'];
        $sql = "select nomProduit from Produit where idProduit<>$id and nomProduit='".$nomProd."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<script>alert(\"nom de produit est deja exist\")</script>";
            $conn->close();
        }
        else
        {
            $conn = new mysqli("localhost", "root", "", "vente");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $idCat=$_POST['categorieselect'];
            $prix=$_POST['prix'];
            $qteStock=$_POST['qteStock'];
            $panierStandard=0;
            if(isset($_POST['panierStandard'])){
            $panierStandard=1;
            }
            $quantitepanier=$_POST['quantitepanier'];
            $sql = "UPDATE produit SET idCategorie=$idCat, nomProduit='$nomProd', prix=$prix, quantiteStock=$qteStock, produtit_panier_standard=$panierStandard , qte_ligne_panier_standard=$quantitepanier where idProduit=$id";
            if($_FILES['imageProd']['tmp_name'])
            {
                $imageProduit=addslashes(file_get_contents($_FILES['imageProd']['tmp_name']));
                $sql = "UPDATE produit SET imageProduit='$imageProduit', idCategorie=$idCat, nomProduit='$nomProd', prix=$prix, quantiteStock=$qteStock, produtit_panier_standard=$panierStandard , qte_ligne_panier_standard=$quantitepanier where idProduit=$id";
            }
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert(\"modification de la produit terminer avec succès\")</script>";
            } else {
                echo "Error: ";
            }
            $conn->close();
            echo '<script>javascript:history.go(-1);</script>';
        }
    }
    if(isset($_POST['deleteProduit']))
    {
        
        echo "<script>if(confirm('Voulez-vous vraiment supprimer ce produit?'))
        {window.location.href = 'deleteProduit.php?id=$id'};
        </script>";
    }
?>
