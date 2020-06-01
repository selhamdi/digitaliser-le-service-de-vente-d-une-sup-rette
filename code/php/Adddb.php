<?php
include('menu.php');
// session_destroy();
// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $idUser = $_SESSION['id'];
print_r($_SESSION);

?>
 <?php foreach($_SESSION as $key => $value):?>
    <?php 
       ?>
            <?php if(substr($key,0,7) == "produit"):
                //  print_r($value)
                  
                ?>
              <?php 

                $idProduit=$value['idPro'];
                $idUser = $value['id'];
                $qte=$value['qte'];
              
                $sql="INSERT INTO panier (idProduit, idUser, qteLignePanier) VALUES ($idProduit, $idUser, $qte)";
                if ($conn->query($sql) === TRUE) {
                  echo "New record created successfully";
                } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
              break;
                ?>
            <?php endif;?>
          
<?php endforeach;
 header('Location:panier.php');
?>