<?php

echo   '<footer>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Document</title>
</head>
<style>
body {
  overflow-x:hidden
}
footer {
    margin-top:22%;
    background: #f5f5f5;
    color: black;
  }
  
  footer a {
    color: #aaa;
  }
  
  footer a:hover {
    color: #fff;
  }
  
  footer h3 {
   color: #17a2b8;
    letter-spacing: 1px;
    margin: 30px 0 20px;
  }
  
  footer .three-column {
   overflow: hidden;
  }
  
  footer .three-column li{
   width: 33.3333%;
    float: left;
    padding: 5px 0;
  }
  
.media-body {
    padding: 0 5%;
  }

  footer .socila-list {
    overflow: hidden;
    margin: 20px 0 10px;
  }
  
  footer .socila-list li {
    float: left;
    margin-right: 3px;
    opacity: 0.7;
    overflow: hidden;
    border-radius: 50%;
    transition: all 0.3s ease-in-out;
  }
  
  footer .socila-list li:hover {
    opacity: 1;
  }
  
  footer .img-thumbnail {
    background: rgba(0, 0, 0, 0.2);
    border: 1px solid #444;
    margin-bottom: 5px;
    width: 150px;
    height: 100px;
  }
  
  footer .copyright {
    padding: 15px 0;
    background: #b2b5b7;
    margin-top: 20px;
    font-size: 15px;
  }
  
  footer .copyright span {
    color: blue;
  }

 #image {
    width: 48px;
    height: 48px;
  }

#contact {
   width: 64px;
   height: 64px;
}
</style>
<body>
<div class="container">
  <div class="row">
    
    <div class="col-lg-4 col-md-6">
      <h3>Nos Social media</h3>
 
      <ul class="list-unstyled socila-list">
        <li><img id="image" src="../images/facebook.jpg" alt="" /></li>
        <li><img id="image" src="../images/Youtube.jpg" alt="" /></li>
        <li><img id="image" src="../images/Twitter.jpg" alt="" /></li>
        <li><img id="image" src="../images/Pinterest.jpg" alt="" /></li>
        <li><img id="image" src="../images/store.jpg" alt="" /></li>
        <li><img id="image" src="../images/bloger.jpg" alt="" /></li>
      </ul>
    </div>
    
    <div class="col-lg-4 col-md-6">
      <h3>Nos Dernier Ratings</h3>
      <div class="media">
        <a href="#" class="pull-left">
          <img id="contact" src="https://image.freepik.com/vecteurs-libre/profil-avatar-homme-icone-ronde_24640-14044.jpg" alt="" class="media-object" />
        </a>
        <div class="media-body">
          <h4 class="media-heading">T.taha</h4>t
          <p>I received my shipped order in sonic speed <br>★★★★★</p>
        </div>
      </div>
      
      <div class="media">
        <a href="#" class="pull-left">
          <img id="contact" src="https://image.freepik.com/vecteurs-libre/profil-avatar-homme-icone-ronde_24640-14044.jpg" alt="" class="media-object" />
        </a>
        <div class="media-body">
          <h4 class="media-heading">S.mehdi</h4>
          <p>fraud website dont buy from it <br>★</p>
        </div>
      </div>
      
      <div class="media">
        <a href="#" class="pull-left">
          <img id="contact" src="https://image.freepik.com/vecteurs-libre/profil-avatar-homme-icone-ronde_24640-14044.jpg" alt="" class="media-object" />
        </a>
        <div class="media-body">
          <h4 class="media-heading">N.Jamal</h4>
          <p>Still waiting for my package from 2010 <br> ★★</p>
        </div>
      </div>
      
    </div>
    
    <div class="col-lg-4">
      <h3>Nos Type de produits</h3>
      <img class="img-thumbnail" src="https://1.bp.blogspot.com/-_U8vlciRCDY/WgXSPCPH2WI/AAAAAAAAANo/wghU-3c174QnrrzEDniQx87XRqTSN1OBQCLcBGAs/s640/How-to-save-money-while-shopping-online-4-2-iloveimg-compressed.jpg" alt="" />
      <img class="img-thumbnail" src="https://www.fourchette-et-bikini.fr/sites/default/files/styles/full_670x350/public/shutterstock_641814016.jpg?itok=WyUOj6w9" alt="" />
      <img class="img-thumbnail" src="https://img.freepik.com/photos-gratuite/composition-vendredi-noir-quatre-sacs-panier_23-2147709334.jpg?size=626&ext=jpg" alt="" />
      <img class="img-thumbnail" src="https://media.istockphoto.com/photos/closeup-the-colorful-shopping-bags-were-holding-by-lady-handin-front-picture-id958774962?k=6&m=958774962&s=612x612&w=0&h=FRnalJ1ti2v7d0DhGV_Vuwr2d4P22bOliozlEEOUpNs=" alt="" />
    </div>
    
  </div>
</div>
<div class="copyright text-center">
  Copyright &copy; 2020 <span>Shopping</span>
</div>
</footer>
</body>
</html>';
?>

