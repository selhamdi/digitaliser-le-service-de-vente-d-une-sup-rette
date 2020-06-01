<?php
session_start();
// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['Ajouter'])){
    $id = $_POST['id'];
    // $nom = $_POST['nom'];
    // $prix = $_POST['prix'];
    $qte = $_POST['qte'];
    $sql = "SELECT * FROM produit WHERE idProduit=$id";
    $result = mysqli_query($conn, $sql);
    // die(print_r($id));
    $produit = mysqli_fetch_array($result);
    // if (!$produit) {
    //    printf("Error: %s\n", mysqli_error($con));
    //     exit();
    // }
    // die(print_r($produit));
    $_SESSION['produit'.$id]= array(
        'id'=>$produit['idProduit'],
        'nom'=>$produit['nomProduit'],
        'prix'=>$produit['prix'],
        'total'=>$produit['prix'] * $qte,
        'qte'=>$qte,
    );
    $_SESSION['totaux'] += $_SESSION['produit'.$id]['total'];
    $_SESSION['cont'] +=1;
    header('Location:Adddb.php');

   
}

?>