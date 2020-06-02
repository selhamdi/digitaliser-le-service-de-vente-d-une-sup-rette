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
<div class="row">
<?php
    while ($row = mysqli_fetch_array($result)) {

        ?>
        <div class="col-md-3">
            
            <div class="card"> 
            <form method="post" action=""> 
            <?php  
              echo' <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />'   
                 ?>   
            
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["nomProduit"]; ?></h5>
                        <p class="card-text text-right"><?php echo $row["prix"]; ?>Dh</p>
                        <input type="hidden" name="hidden_name" value="<?php echo $row["nomProduit"];  ?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $row["prix"];  ?>">
                        <input type="hidden" name="quantiteStock" value="<?php echo $row["quantiteStock"];  ?>">
                        
                        Qte:
                        <select name="qte" id="">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
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
$hidden_name =null;
$hidden_price =null;
$quantiteStock=null;
$message = "already added";

if ( isset( $_POST['add_to_cart'] ) ) {

    // retrieve the form data by using the element's name attributes value as key
    
    
    
    $hidden_name = $_POST['hidden_name'];
    $hidden_price = $_POST['hidden_price'];
    $quantiteStock =intval( $_POST['quantiteStock']);
    
   
    $qte = intval($_POST['qte']);
    $quantiteStock= $quantiteStock- $qte;
    $query1 = "UPDATE produit SET quantiteStock = '$quantiteStock' WHERE produit.nomProduit = '$hidden_name'";
    $Result_update= mysqli_query($conn,$query1);


    $query3="SELECT * from panier_standard WHERE panier_standard.name_order = '$hidden_name'";
    $Result_check= mysqli_query($conn,$query3);

    if($Result_check->num_rows > 0){
       
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
        $query2 = "INSERT INTO panier_standard (name_order, quantity, prix)
        VALUES ('$hidden_name', '$qte', '$hidden_price' )";
    
        $Result_insert= mysqli_query($conn,$query2);
    }
   

    
    // // display the results
    // echo 'Your name is ' . $hidden_name .' ' . $hidden_price;
    
}

    $query4 = "SELECT * from panier_standard ";
    $Result_display= mysqli_query($conn,$query4);
?>
<div class="title_section">
    <h1>Éléments du panier</h1>
</div>
<?php
$total;  
if ($result->num_rows > 0) {
    echo '<table class="table">
    <thead>
      <tr>
        <th scope="col">nom produit</th>
        <th scope="col">quantité</th>
        <th scope="col">prix</th>
        <th scope="col">total</th>
        <th scope="col">remove</th>
      </tr>
    </thead>';
    while($row = mysqli_fetch_array($Result_display))  
            {  
                $total=$row['prix']*$row['quantity'];
                echo '<tbody>
                <tr>
                  <td>'.$row['name_order'].'</td>
                  <td>'.$row['quantity'].'</td>
                  <td>'.$row['prix'].'</td>
                  <td>'.$total.'</td>
                  <td>'
                  ?>
                  <form method="post" action="">
                  <input type="hidden" name="name_order" value="<?php echo $row["name_order"];  ?>">
                  <button type="submit" name="remove" class="btn btn-primary">Remove</button>
                </form></td>
                </tr>
                <?php          ;  
            }

    echo '</tbody>
    </table>';

} 
else {
echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
}
echo '</div>';
$name_order=null;
if ( isset( $_POST['remove'] ) ){
    echo $name_order;
    $name_order = $_POST['name_order'];
    $query5="DELETE FROM panier_standard WHERE name_order='$name_order'";
    $Result_delete=mysqli_query($conn,$query5); 
}




$conn->close();
include('footer.php');
?>