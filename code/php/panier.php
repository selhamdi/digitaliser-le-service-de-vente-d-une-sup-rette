<?php
include('menu.php');
include('header.php');
$id=$_SESSION['Client'];
if(isset($_GET["id"]) && !empty( $_GET['id'] ))
    {
        $conn = new mysqli("localhost", "root", "", "vente");
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $idprodui=$_GET["id"];
        $sql = "INSERT INTO panier(idProduit,idUser,qteLignePanier) VALUES($idprodui,$id,1)";
        $result = mysqli_query($conn, $sql); 
        $conn->close();
    }
$conn = new mysqli("localhost", "root", "", "vente");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

?>
<?php
$query = "SELECT produit.* FROM produit,panier WHERE panier.idUser=$id and produit.idProduit=panier.idProduit ORDER BY `produit`.`idProduit` ASC ";
$result = mysqli_query($conn,$query);  
              
if(mysqli_num_rows($result) > 0) {?>
<div class="title_section">
    <h1>Panier</h1>
</div>
<div class="divstandard">
<div class="row">
<?php
    while ($row = mysqli_fetch_array($result)) {

        ?>
        <div class="col-md-3">
<form method="post" action="" name="myform">
            
            <div class="card"> 
           
            <?php  
              echo' <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />'   
                 ?>   
            
                    <div class="card-body">
                        <h5 class="card-title" name="nomProduit"><?php echo $row["nomProduit"]; ?></h5>
                        <p class="card-text text-right"><?php echo $row["prix"]; ?>Dh</p>
                      
                        <?php  
                        echo "Qte:
                        <select name='qte'>";
                        $sql = "SELECT produit.quantiteStock FROM `produit` WHERE idProduit=".$row["idProduit"];
                        $result1 = $conn->query($sql);
                        $row1 = $result1->fetch_assoc();
                        $sql = "SELECT panier.qteLignePanier FROM `panier` WHERE idUser=$id AND idProduit=".$row["idProduit"];
                        $result1 = $conn->query($sql);
                        $row2 = $result1->fetch_assoc();
                        for ($i=1;$i<=$row1["quantiteStock"];$i++) {
                            echo "<option value='$i' ";
                            if($i==$row2["qteLignePanier"])
                            {
                                echo "selected";
                            }
                            
                            echo ">$i</option>";
                        }
                        echo"</select> <input type='submit' name='update[". $row["idProduit"]."]' style='margin-top:5px;' class='btn btn-info' value='select'/><br>
                        <input type='submit' name='remove[". $row["idProduit"]."]' style='margin-top:5px;' class='btn btn-info' value='retirer' />";   
                 ?>
                        
                    </div>
                    
                    </div>
            </form>
                     </div>
                    <?php              
            }
            ?>
            </div>
            <form method="post" action="">
            <input type="button" style="margin-top:5px;" class="btn btn-info" value="Reserver" onclick="affiche()"/>
               </form>
                     
                     
  
  
  </div>




  <?php   
} 

$sql = "SELECT SUM(prix*qteLignePanier) as prixT FROM panier,produit WHERE idUser=$id AND panier.idProduit=produit.idProduit ";
$result1 = $conn->query($sql);
$row = $result1->fetch_assoc();
$totale_price=$row["prixT"];
$date_time=date('y-m-d');



if ( isset( $_POST['Reserver'] ) ) {
        $telephone=$_POST["telephone"];
        $adresse=$_POST["adresse"];
        $query2="INSERT INTO commande(idUser, dateCommande, PrixUT, etat_commande, is_standard,telephone,adresse)

        VALUES ( $id, '$date_time', $totale_price,'En Attente',0,'$telephone','$adresse' )";
        
        $Result_insert= mysqli_query($conn,$query2) ;

        $last_id= mysqli_insert_id($conn);
        $query = "SELECT produit.* FROM produit,panier WHERE panier.idUser=$id and produit.idProduit=panier.idProduit ORDER BY `produit`.`idProduit` ASC";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_array($result)) {
            $sql = "INSERT into lignecommande(idProduit,idCommande,qteLigneCommande) VALUES(".$row['idProduit'].",$last_id,".$row['qte_ligne_panier_standard'].")";
            $result1 = $conn->query($sql);
            $sql = "DELETE from panier WHERE idProduit=".$row['idProduit']." and idUser=$id";
            $result1 = $conn->query($sql);
        }
        echo "<script type='text/javascript'>alert('reservation terminer');window.location.href = 'index.php'</script>";
}
if ( isset( $_POST['remove'] ) ) {
    $remove=array_keys($_POST["remove"])[0];
    $sql = "DELETE from panier WHERE idProduit=$remove and idUser=".$id;
    $result1 = $conn->query($sql);
    echo "<script type='text/javascript'>alert('retirer terminer');</script>";
    echo "<script type='text/javascript'>window.location.href = 'panier.php'</script>";
}
if ( isset( $_POST['update'] ) ) {
    $selectOption = $_POST['qte'];
    $idP=array_keys($_POST["update"])[0];
    $sql = "UPDATE panier set qteLignePanier=$selectOption WHERE idProduit=$idP and idUser=$id";
    $result1 = $conn->query($sql);
}
$conn->close();
include('footer.php');

echo '<div class="blockresrev" id="reservpop"><div class="resrev">
<form method="post" action="">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-4 col-form-label">telephone</label>
    <div class="col-sm-7">
      <input type="tele" name="telephone" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-4 col-form-label">adresse</label>
    <div class="col-sm-7">
      <input type="text" name="adresse" class="form-control">
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-info btn-lg" name="Reserver">Reserver</button>
      <button type="button" class="btn btn-secondary btn-lg" onclick="disable()">Annuler</button>
    </div>
  </div>
</form>
</div></div>';
?>
<script>
    function affiche() {
        document.getElementById('reservpop').style.display="inline";
    }
    function disable() {
        document.getElementById('reservpop').style.display="none";
    }
</script>