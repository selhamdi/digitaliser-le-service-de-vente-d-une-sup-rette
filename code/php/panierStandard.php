<?php
include('menu.php');
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
                      
                        
                        Qte:
                        <select name="qte" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select> <br>
                        
                    </div>
                    
                    </div>
                     </div>
                    <?php              
            }
            ?>
            </div>
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
               </form>
                     
                     
  
  
  </div>




  <?php   
} 

$message = "exceeds allowed limit";
$totale_price=1;
$date_time=1111-11-11;



if ( isset( $_POST['add_to_cart'] ) ) {
   
    $query3="SELECT * from commande ";
    $Result_check= mysqli_query($conn,$query3);
    
 
    
  
    if($Result_check->num_rows > 2){
       
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    
    else{

        $query2="INSERT INTO commande( dateCommande, PrixUT, etat_commande, is_standard)

        VALUES (  '$date_time', '$totale_price','En Attente',1 )";
        
          $Result_insert= mysqli_query($conn,$query2) ;
    }
   

}

$conn->close();
include('footer.php');
?>