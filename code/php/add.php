<?php
 session_start();
// print_r($_SESSION);
// include('menu.php');
// session_destroy();

// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_GET['id'])) {
$id = $_GET['id'];
$sql = "SELECT * FROM produit WHERE idProduit='$id'";
$result = mysqli_query($conn, $sql);
}

?>

<?php $row = mysqli_fetch_assoc($result)?>
<form method="POST" action="chekout.php">
   
    <input value="<?php echo $row['idProduit'] ?>" name="id" type="hidden">
    <input value="<?php echo $row['nomProduit'] ?>" name="nom">
    <input value="<?php echo $row['prix'] ?>" name="prix">DH
    <div class="form-group">
    <label for="">Qte</label>
    <input type="number" name="qte" value="1">
    </div>
    <button class="btn btn-danger" type="submit" name="Ajouter">Ajouter</button>
</form>