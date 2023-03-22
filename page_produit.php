<?php
require_once 'class/connection.php';

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
    
<?php 
 // Récupération des informations du produit
$id = $_GET['id'];
$produit = $produit->getById($id);

// Affichage des informations du produit
echo '<img src="' . $produit['image'] . '" alt="' . $produit['titre'] . '">';
echo '<h1>' . $produit['titre'] . '</h1>';
echo '<p>Date de publication : ' . $produit['date_publication'] . '</p>';
echo '<p>Catégorie : ' . $produit['categorie'] . '</p>';
echo '<p>Taille : ' . $produit['taille'] . '</p>';
echo '<p>État : ' . $produit['etat'] . '</p>';
echo '<p>Matériau : ' . $produit['materiau'] . '</p>';
echo '<p>Couleur : ' . $produit['couleur'] . '</p>';
echo '<p>Description : ' . $produit['description'] . '</p>';

?>


</body>
</html>