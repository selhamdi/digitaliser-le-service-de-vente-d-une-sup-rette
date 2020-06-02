<?php
    include('menu.php');
    echo '
    <style>
      body {
        background : #343a40;
      }
    </style>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
     <div class="carousel-inner">
       <div class="carousel-item active">
         <img style="height:500px;" class="d-block w-100" src="../images/ps5.png" alt="First slide">
        </div>
       <div class="carousel-item">
         <img style="height:500px;" class="d-block w-100" src="../images/Alienware.jpg" alt="Second slide">
       </div>
       <div class="carousel-item">
         <img style="height:500px;" class="d-block w-100" src="../images/slide5.jpg" alt="Third slide">
       </div> 
     </div>
     <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
     </a>
   </div>';
   
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
                          <a href="produit.php"><button type="button" name="ajoutePanier" class="btn btn-light btn-lg">Ajouter au panier</button></a>
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
                          <a href="produit.php"><button type="button" name="ajoutePanier" class="btn btn-light btn-lg">Ajouter au panier</button></a>
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
                          <a href="produit.php"><button type="button" name="ajoutePanier" class="btn btn-light btn-lg">Ajouter au panier</button></a>
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