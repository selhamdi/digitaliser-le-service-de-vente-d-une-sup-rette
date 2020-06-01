<?php
    include('menu.php');
    include('header.php');
    echo '<div class="divstandard">';
    $conn = new mysqli("localhost", "root", "", "vente");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `produit` ORDER BY `produit`.`idProduit` ASC ";
    $result = mysqli_query($conn, $sql);  
                  
    if ($result->num_rows > 0) {
        echo '<div class="row">';
        while($row = mysqli_fetch_array($result))  
                {  
                    echo "<div class='col-md-3'>
            
                    <div class='card'> 
                    <form method='post' action=''>
                      <img src='data:image/jpeg;base64,".base64_encode($row['imageProduit'] )."' class='card-img-top' height='200' />
                    
                            <div class='card-body'>
                                <h5 class='card-title'>".$row['nomProduit']."</h5>
                                <p class='card-text text-right'>".$row['prix']." Dh</p>
                                
                                Qte:
                                <select name='qte'>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>1</option>
                                    <option value='5'>2</option>
                                    <option value='6'>3</option>
                                </select> <br>
                                <input type='submit' name='remove' style='margin-top:5px;' class='btn btn-success' value='retirer' />
                            </div>
                            
                            </form>
                             
                            </div>
                            </div>';";
                }  
        echo "</div>
        <a href='addProduit.php'><button type='button' class='btn btn-light btn-lg'>Reserver</button></a>";
        
    } 
    else {
    echo '<p class="text-center font-weight-bolder">Aucun Produit</p>';
    }
    $conn->close();
    echo '</div>';
    include('footer.php');
?>