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
<div class="divstandard">
<div class="row">
<?php
    while ($row = mysqli_fetch_array($result)) {

        ?>
        <div class="col-md-3">
            
            <div class="card"> 
            <form method="post" action="Cart.php?action=add&id=<?php echo $row["id"]; ?>"> 
            <?php  
              echo' <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />'   
                 ?>   
            
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["nomProduit"]; ?></h5>
                        <p class="card-text text-right"><?php echo $row["prix"]; ?>Dh</p>
                        <input type="hidden" name="hidden_name" value="<?php echo $row["nomProduit"];  ?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row["prix"];  ?>">
                        
                        Qte:
                        <select name="qte" id="">
                            <option value="0">1</option>
                            <option value="1">2</option>
                            <option value="2">3</option>
                        </select> <br>
                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
                    </div>
                    
                    </form>
                     
                    </div>
                    </div>
                    <?php              
            }
            ?>
  
  </div>
  </div>




  <?php   
} 
$conn->close();
include('footer.php');
?>