<?php
require_once 'class/connection.php';
$connection = new Connection();
$id = $_GET['id'];
$product = $connection->getProductById($id);
$category = $connection->getCategory($product['id']);
$state = $connection->getState($product['id']);
$size = $connection->getSize($product['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page produits</title>
</head>
<body>
    
<!-- Affichage des informations du produit -->
    <h2><?= $product['title'] ?></h2>
    <p><?= date("d/m/Y", strtotime($product['publication'])) ?></p>
    <p><?= $category['title'] ?></p>
    <p><?= $state['title'] ?></p>
    <p><?= $size['title'] ?></p> 

</body>
</html>
