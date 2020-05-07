<?php
    session_start();
    $_SESSION['$id']='admin';
    echo '<!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/style.css">
            <title>T9adyti</title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <a class="navbar-brand" href="#">T9adyti</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Accueil</a>
                    </li>';
    if(!isset($_SESSION))
    {
        echo '<li class="nav-item">
                <a class="nav-link" href="produit.php">Produit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inscription.php">Inscription/connection</a>
            </li>';
    }
    else
    {
        if($_SESSION['$id']=='admin')
        {
            echo '<li class="nav-item">
                    <a class="nav-link" href="categorie.php">Categorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listProduit.php">Produit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerePanierStandard.php">Panier standard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Commandes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="commandesCours.php">commandes en cours</a>
                    <a class="dropdown-item" href="commandesFini.php">Commandes fini</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="commandesRefuse.php">commandes refuse</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>';
        }
        else
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
    }
    echo '      </ul>
            </div>
        </nav>
        <script src="../js/jquery-3.4.1.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
    </html>';
?>