<?php
    session_start();
    echo '<!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <link rel="stylesheet" href="../css/style.css">
            <link rel="stylesheet" href="../css/inscrire.css">
            <link rel="stylesheet" href="../css/footer.css">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <title>T9adyti</title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light>
                <a class="navbar-brand" href="#">T9adyti</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Accueil</a>
                    </li>';            
    if($_SESSION == null)
    {
        echo '<li class="nav-item">
                <a class="nav-link" href="produit.php">Produit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inscription.php">Inscription/connection</a>
            </li>';
    }
        if(isset($_SESSION['admin']))
        {
            echo '<li class="nav-item">
                    <a class="nav-link" href="categorie.php">Categorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listProduit.php">Produit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="managePanierStandard.php">Panier standard</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Commandes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="commandesCours.php">commandes en cours</a>
                    <a class="dropdown-item" href="commandesStandard.php">Commandes standard</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="commandesFini.php">Commandes fini</a>
                        <a class="dropdown-item" href="commandesRefuse.php">commandes refuse</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>';
    } 
    if (isset($_SESSION['Client']))
        {
            echo '<li class="nav-item">
                <a class="nav-link" href="produit.php">Produit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="panier.php">Panier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="panierStandard.php">Panier standard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="myCommande.php">Commande</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>';
        
    }

    echo ' </ul>
        </div>
        </nav>
        <script src="../js/jquery-3.4.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>
        $("#navbarDropdown").click(function(){
            $(".dropdown-menu").toggle();
          });
        </script>
    </body>
    </html>';

?>