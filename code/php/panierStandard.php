<?php
include('menu.php');
include('header.php');
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
$id=$_SESSION['Client'];
$conn = new mysqli("localhost", "root", "", "vente");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

?>
<?php
$query = "SELECT * FROM `produit` where produtit_panier_standard= 1";
$result = mysqli_query($conn,$query);  
              
if(mysqli_num_rows($result) > 0) {?>
<div class="title_section">
    <h1>Produits Standards</h1>
</div>
<div class="divstandard">
<form method="post" action="">
<div class="row">

<?php
    while ($row = mysqli_fetch_array($result)) {

        ?>
        <div class="col-md-3">
            
            <div class="card"> 
           
            <?php  
              echo' <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />'   
                 ?>   
            
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["nomProduit"]; ?></h5>
                        <p class="card-text text-right"><?php echo $row["prix"]; ?>Dh</p>
                      
                        <?php  
                        echo "<p>qte : ".$row['qte_ligne_panier_standard']."</p>";   
                 ?>
                        
                    </div>
                    
                    </div>
                     </div>
                    <?php              
            }
            ?>
            </div>
            <input type="button" style="margin-top:5px;" class="btn btn-info" value="Reserver" onclick="affiche()"/>
               </form>
                     
                     
  
  
  </div>




  <?php   
} 

$message = "exceeds allowed limit";
$sql = "SELECT SUM(prix*qte_ligne_panier_standard) as prixT FROM produit WHERE produtit_panier_standard=1 ";
$result1 = $conn->query($sql);
$row = $result1->fetch_assoc();
$totale_price=$row["prixT"];
$date_time=date('y-m-d');



if ( isset( $_POST['Reserver'] ) ) {
   
    $query3="SELECT count(*) as nomber FROM commande where idUser=$id and dateCommande='$date_time'";
    $Result_check= mysqli_query($conn,$query3);
    $row = mysqli_fetch_array($Result_check);
 
    
  
    if($row['nomber'] > 2){
       
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
    else{
        $telephone=$_POST["telephone"];
        $adresse=$_POST["adresse"];
        $query2="INSERT INTO commande(idUser, dateCommande, PrixUT, etat_commande, is_standard,telephone,adresse)

        VALUES ( $id, '$date_time', $totale_price,'En Attente',1,'$telephone','$adresse' )";
        
        $Result_insert= mysqli_query($conn,$query2) ;

        $last_id= mysqli_insert_id($conn);
        $query = "SELECT * FROM `produit` where produtit_panier_standard= 1";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_array($result)) {
            $sql = "INSERT into lignecommande(idProduit,idCommande,qteLigneCommande) VALUES(".$row['idProduit'].",$last_id,".$row['qte_ligne_panier_standard'].")";
            $result1 = $conn->query($sql);
        }
        
        echo "<script type='text/javascript'>alert('reservation terminer');window.location.href = 'index.php'</script>";
    }
   

}

$conn->close();
include('footer.php');

?>
<script>
    function affiche() {
        document.getElementById('reservpop').style.display="inline";
    }
    function disable() {
        document.getElementById('reservpop').style.display="none";
    }
</script>