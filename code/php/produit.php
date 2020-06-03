<?php
  include('menu.php');
  
  echo '
  <style>
    #carouselExampleControls {
      margin-top: 2%;
    }
    .search {
      margin-top: 2%;
      margin-left: 30%;
    }
    #input {
      width: 30%;
    } 
  </style>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
   <div class="carousel-inner">
     <div class="carousel-item active">
       <img style="height:500px;" class="d-block w-100" src="../images/slide1.jpg" alt="First slide">
      </div>
     <div class="carousel-item">
       <img style="height:500px;" class="d-block w-100" src="../images/slide2.jpg" alt="Second slide">
     </div>
     <div class="carousel-item">
       <img style="height:500px;" class="d-block w-100" src="../images/slide3.jpg" alt="Third slide">
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

 echo '<div class="search">
 <form action="" method="post" class="form-inline my-2 my-lg-0">
 <input  name="requete" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="input">
 <button class="btn btn-light btn-lg" type="submit">Search</button>
</form>
</div>'; 
 
    echo '<div class="divstandard">';
    $conn = new mysqli("localhost", "root", "", "vente");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if ( isset($_POST['requete']) ) 
        $requete = htmlentities($conn->real_escape_string($_POST['requete']));
        
    if (!empty($requete)) {
        $req = "SELECT * FROM produit WHERE nomProduit LIKE '%$requete%'"; 
        $exec = $conn->query($req);                            
// exécuter la requête
        $nb_resultats = $exec->num_rows;              // compter les résultats

      echo '<div class="row">';
      while($donnees = mysqli_fetch_array($exec))  
              {  
                  echo '<div class="col-sm-4 cardProduit">
                  <div class="card">
                  <img src="data:image/jpeg;base64,'.base64_encode($donnees['imageProduit'] ).'" class="card-img-top" height="300"/>  
                  <div class="card-body">
                      <h5 class="card-title">'.$donnees['nomProduit'].'</h5>
                      <p class="card-text text-right">'.$donnees['prix'].' Dh</p>
                      <a href="add.php?idPro='.$donnees["idProduit"].'"><button type="button" name="ajoutePanier" class="btn btn-light btn-lg">Ajouter au panier</button></a>
                  </div>
                  </div>
                  </div>';  
              } // fin de la boucle
      echo '</div>';
 
  }  else {
    $sql = "SELECT * FROM `produit` ORDER BY `produit`.`idProduit` ASC ";
    $result = mysqli_query($conn, $sql);  
                  
    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while($row = mysqli_fetch_array($result))  
                {  
                    echo '<div class="col-sm-4 cardProduit">
                    <div class="card">
                    <img src="data:image/jpeg;base64,'.base64_encode($row['imageProduit'] ).'" class="card-img-top" height="300"/>  
                    <div class="card-body">
                        <h5 class="card-title">'.$row['nomProduit'].'</h5>
                        <p class="card-text text-right">'.$row['prix'].' Dh</p>
                        <a href="add.php?idPro='.$row["idProduit"].'"><button type="button" name="ajoutePanier" class="btn btn-light btn-lg">Ajouter au panier</button></a>
                    </div>
                    </div>
                    </div>';  
                }
        echo '</div>';
 
    } 
    else {
    echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
    }
  } 
    $conn->close();
    echo '</div>';
    include('footer.php');

 ?>  


