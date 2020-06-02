<?php
include('menu.php');
include('header.php');
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
            <input type="submit" name="Reserver" style="margin-top:5px;" class="btn btn-info" value="Reserver" />
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

        $query2="INSERT INTO commande(idUser, dateCommande, PrixUT, etat_commande, is_standard)

        VALUES ( $id, '$date_time', $totale_price,'En Attente',1 )";
        
        $Result_insert= mysqli_query($conn,$query2) ;

        $last_id= mysqli_insert_id($conn);
        $query = "SELECT * FROM `produit` where produtit_panier_standard= 1";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_array($result)) {
            $sql = "INSERT into lignecommande(idProduit,idCommande,qteLigneCommande) VALUES(".$row['idProduit'].",$last_id,".$row['qte_ligne_panier_standard'].")";
            $result1 = $conn->query($sql);
        }
        echo "<script type='text/javascript'>alert('reservation terminer');</script>";
    }
   

}

$conn->close();
include('footer.php');
?>