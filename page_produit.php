<?php
require_once 'class/connection.php';
$connection = new Connection();
$id = $_GET['id'];
$product = $connection->getProductById($id);
$category = $connection->getCategory($product['id']);
$color = $connection->getColor($product['id']);
$matter = $connection->getMatter($product['id']);
$state = $connection->getState($product['id']);
$size = $connection->getSize($product['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/pages/product.css">
    <title>Page produits</title>
</head>
<body>
    

<header>
    <div class="nav">
        <p>Logo</p>
    </div>
</header>

<!-- Affichage des informations du produit -->

    <div class="product-page">
    <div class="product-image">
         <img src="images/uploads/products/Photos1.png" alt="front pic">
    </div>
    <div class="product-details">
        <h1 class="product-title"><?= $product['title'] ?></h1>
        <p><?= date("d/m/Y", strtotime($product['publication'])) ?></p>
        <ul class="product-info">
            <li><span>Category:</span> <?= $category['title'] ?> </li>
            <li><span>Brand:</span> <?= $product['brand'] ?> </li>
            <li><span>Color:</span> <?= $color['title'] ?> </li>
            <li><span>Material:</span> <?= $matter['title'] ?> </li>
            <!-- <li><span>State:</span> <?= $state['title'] ?> </li> -->
            <li><span>Size:</span> <?= $size['title'] ?> </li>
        </ul>
        <!-- <h3>Descriptoin :</h3> -->
        <p class="product-description"> <?= $product['description'] ?> </p>
        <button class="product-button"> <p>Contacter le propriétaire</p> </button>
    </div>
</div>
    


<footer class="footer">
    <div class="container">
        <div class="row">
         <div class="footer-col">
                <div class="logo">
                 <img src="images/Logo_Plessis_Robinson 2.png" alt="">
                </div>
            </div>
            <div class="footer-col">
                <h4>Le Plessis-Robinson</h4>
                <ul>
                    <li>Téléphone</li>
                    <li>Mail</li>
                    <li>Adresse</li>
                    <li>Horaires</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Réseau 1</h4>
                <ul>
                    <li><a href="#">Réseau 2</a></li>
                    <li><a href="#">Réseau 3</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Pages</h4>
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Faire un don</a></li>
                    <li><a href="#">Voir les objets donnés</a></li>
                </ul>
            </div>

        </div>
    </div>
    <br><br>

    <div class="container">
     <div class="row">
      <div class="footer-col">
             <div class="logo">
              <img src="images/logo_Maison_des_Part'Ages 1.png" alt="">
             </div>
         </div>
         <div class="footer-col">
             <h4>La maison des Part’Âges</h4>
             <ul>
                 <li>Téléphone</li>
                 <li>Mail</li>
                 <li>Adresse</li>
                 <li>Horaires</li>
             </ul>
         </div>
         <div class="footer-col">
             <h4>Réseau 1</h4>
             <ul>
                 <li><a href="#">Réseau 2</a></li>
                 <li><a href="#">Réseau 3</a></li>
             </ul>
         </div>
         <div class="footer-col">
             <h4>Conditions générales</h4>
             <ul>
                 <li><a href="#">Mentions légales</a></li>
                 <br><br>
                 <li><a href="#">2023 All Rights Reserved</a></li>
             </ul>
         </div>

     </div>
 </div>
</footer>



</body>
</html>