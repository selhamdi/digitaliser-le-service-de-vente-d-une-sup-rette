<?php
    include('menu.php');
    include('header.php');
    echo '
    <style>
      body {
        background : #343a40;
      }
    </style>
    ';
   
      echo '<div class="divstandard">';
      $conn = new mysqli("localhost", "root", "", "vente");
      // Check connection
      if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      }
  
      $sql = "SELECT * FROM `produit` where idCategorie='1' limit 3";
      $result = mysqli_query($conn, $sql);  
                    
      if ($result->num_rows > 0) {
          echo '<div class="row">';
          while($row = mysqli_fetch_array($result))  
                  {  
                      echo '<div class="col-sm-4 cardProduit">
                      <div class="card">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />  
                      <div class="card-body">
                          <h5 class="card-title">'.$row['nomProduit'].'</h5>
                          <p class="card-text text-right">'.$row['prix'].' Dh</p>
                      </div>
                      </div>
                      </div>';  
                  }
          echo '</div>';
          echo' <a href="produit.php" class="formoreclick">...Click for more</a>';
      } 
      else {
      echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
      }
    
      echo '</div>';
      echo '<div class="divstandard">';
   
  
      $sql = "SELECT * FROM `produit` where idCategorie='2' limit 3";
      $result = mysqli_query($conn, $sql);  
                    
      if ($result->num_rows > 0) {
          echo '<div class="row">';
          while($row = mysqli_fetch_array($result))  
                  {  
                      echo '<div class="col-sm-4 cardProduit">
                      <div class="card">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />  
                      <div class="card-body">
                          <h5 class="card-title">'.$row['nomProduit'].'</h5>
                          <p class="card-text text-right">'.$row['prix'].' Dh</p>
                      </div>
                      </div>
                      </div>';  
                  }
          echo '</div>';
          echo' <a href="produit.php" class="formoreclick">...Click for more</a>';
      } 
      else {
      echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
      }
     
      echo '</div>';
      echo '<div class="divstandard">';
   
  
      $sql = "SELECT * FROM `produit` where idCategorie='3' limit 3";
      $result = mysqli_query($conn, $sql);  
                    
      if ($result->num_rows > 0) {
          echo '<div class="row">';
          while($row = mysqli_fetch_array($result))  
                  {  
                      echo '<div class="col-sm-4 cardProduit">
                      <div class="card">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="200" />  
                      <div class="card-body">
                          <h5 class="card-title">'.$row['nomProduit'].'</h5>
                          <p class="card-text text-right">'.$row['prix'].' Dh</p>
                      </div>
                      </div>
                      </div>';  
                  }
          echo '</div>';
          echo' <a href="produit.php" class="formoreclick">...Click for more</a>';
      } 
      else {
      echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
      }
      $conn->close();
      echo '</div>';
      
      
    include('footer.php');
    
?>