<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['login']))
{

$Email = $_POST['Email'];
$Password= $_POST['Pwd'];
        if($Email&&$Password) {
            $Password = md5($Password);
            $reg = "SELECT * FROM users WHERE email='$Email' AND password_user='$Password'";
            $res = mysqli_query($conn, $reg);
            $rows = mysqli_num_rows($res);
          if($rows==1){
            header('Location:/brief/php') ;
          }else echo '<script>alert("Email ou mot de passe est incorret")</script>';  
    }else echo '<script>alert("Svp Remplir tous les champs !!")</script>';
}   

?>