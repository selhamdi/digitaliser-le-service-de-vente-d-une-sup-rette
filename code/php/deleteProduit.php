<?php
    include('menu.php');
    if(isset($_GET["id"]) && !empty( $_GET['id'] ))
    {
        $id=$_GET["id"];
        $conn = new mysqli("localhost", "root", "", "vente");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE from produit where idProduit=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert(\"Supprision de la produit est terminer avec succès\")</script>";
        } else {
            echo "<script>alert(\"Error \")</script>";
        }
        $conn->close();
        echo '<script>javascript:history.go(-2);</script>';
    }
    else
    {
        echo '<div class="divstandard">
        <p class="text-center font-weight-bolder">Aucun produit sélectionné</p></div>';
    }
?>