<?php 
include('menu.php');
include('connexion.php');
// Create connection
$conn = new mysqli("localhost", "root", "", "vente");  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['submit']))
{
$Nom = $_POST['Nom'];
$Prenom = $_POST['Prenom'];
$Email = $_POST['Email'];
$Password= $_POST['Pwd'];
$Confirm= $_POST['ConfirmPwd'];

    if($Nom&&$Prenom&&$Email&&$Password&&$Confirm)
    {
        if($Password==$Confirm) {
            // $Password = md5($Password);
            $reg = "SELECT * FROM users WHERE nom='$Nom' AND prenom='$Prenom'";
            $res = mysqli_query($conn, $reg);
            $rows = mysqli_num_rows($res);
            if($rows==0) {
            $req = "INSERT INTO users (nom, prenom, email, password_user, type_user) VALUES ('$Nom', '$Prenom', '$Email', '$Password', 'Client')";
			$res = mysqli_query($conn, $req);
			echo '<script>alert("Inscription Bien fait !!")</script>';
            }else echo '<script>alert("ce utilisateur est déjà inscrit")</script>';
        }else echo '<script>alert("le mot de passe est incorrect")</script>';
    }else echo '<script>alert("Svp Remplir tous les champs !!")</script>';
}

?>

<!doctype html>
        <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="../css/bootstrap.min.css">
			<link rel="stylesheet" href="../css/inscrire.css">
            <title>Shopping</title>
		</head>
	<body>
	<div class="container-fluid">
		<div class="container" id="cnt">
			 <div class="border">
			 <h1 class="ml3">Inscription & Connexion</h1>
			 </div>
			<div class="row">
				<div id="main" class="col-md-5">
 					<form role="form" method="post" action="">
						<fieldset>							
 							<div class="form-group">
                                <input type="text" id="first_name" class="form-control input-lg" name="Nom" placeholder="votre nom...">
                            </div>
                            <div class="form-group">
                                 <input type="text" id="last_name" class="form-control input-lg" name="Prenom" placeholder="votre prenom...">
							</div>
							<div class="form-group">
                                <input type="email" id="email" class="form-control input-lg" name="Email" placeholder="votre Adresse E-mail...">
							</div>
							<div class="form-group">
                                <input type="password" id="password" class="form-control input-lg" name="Pwd" placeholder="votre Mot de passe...">
							</div>
							<div class="form-group">
								<input type="password" id="password_confirmation" class="form-control input-lg" name="ConfirmPwd" placeholder="Confirmer le Mot de passe...">
							</div>
 							<div>
                              <input type="submit" value="S'inscrire" class="btn btn-info btn-block" name="submit">
 							</div>
						</fieldset>
					</form>
				</div>
				
				<div class="col-md-2">
					<div class="vl">
					<!-------null------>
					</div>
                </div>
                <div id="main2" class="col-md-5">
 				 		<form role="form" method="POST" action="">
						<fieldset>								
							<div class="form-group">
								<input type="email" name="Email" id="username" class="form-control input-lg" placeholder="votre E-mail...">
							</div>
							<div class="form-group">
								<input type="password" name="Pwd" id="password" class="form-control input-lg" placeholder="votre Mot de passe...">
							</div>
							<div>
                                <input type="submit" value="Connexion" class="btn btn-info btn-block" name="login">
							</div>	 
 						</fieldset>
				</form>	
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script src="../js/animation.js"></script>
	</body>
	</html>
	
<?php	
	include('footer.php');
?>