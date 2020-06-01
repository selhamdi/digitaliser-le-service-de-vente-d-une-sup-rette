<?php

// print_r($_SESSION);
include('menu.php');
// session_destroy();

// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
<style>
    .row {
    margin-top: 6%;
    margin-left: 2%;
    text-align: center;
    }
table{
 border-collapse:collapse;
 width:40%;
 }
th, td {
 border:1px solid black;
 width:20%;
 }
td {
 text-align:center;
 }
 button.btn.btn-light.btn-lg {
    margin-top: 180%;
}
.tableTotal {
    border-collapse: collapse;
    width: 40%;
    margin-top: 10%;
    margin-left: -40%;
}
</style>
<div class="row">
    <table>

    <br>
                <tr>
        <th>produit</th>
        <th>prix</th>
        <th>total</th>
        <th>qte</th>
        </tr>
        <tr>
        <?php foreach($_SESSION as $key => $value):?>
            <?php if(substr($key,0,7) == "produit"):
            ?>

        <td><?php echo $value['nom']?></td>
        <td><?php echo $value['prix']?>DH</td>
        <td><?php echo $value['total']?></td>
        <td><?php echo $value['qte']?></td>
        </tr>
            <?php endif;?>
            <?php endforeach;?>     
    </table>
    <br><br>
    <div class="tableTotal">  
    <table>
        <tr>
            <th>produit</th>
            <th>Somme total</th>
        </tr>
        <th>
            <td><?php echo $_SESSION['cont']?></td>
            <td><?php echo $_SESSION['totaux']?>DH</td>
        </th>
    </table>
    </div>
 
   <div><a class="button" href="commande.php"><button type="button" name="addtodb" class="btn btn-light btn-lg">Payer</button></a></div>
</div>
<?php
include("foter.php");
?>