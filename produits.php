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
foreach ($produits as $produit) {
    echo '<a href="page_produit.php?id=' . $produit['id'] . '">';
    echo '<img src="' . $produit['image'] . '" alt="' . $produit['titre'] . '">';
    echo '</a>';
    echo '<h2>' . $produit['titre'] . '</h2>';
    echo '<p>' . $produit['date_publication'] .'</p>' ;
    echo '<p>' . $produit['categorie'] . '</p>'; 
    echo '<p>' . $produit['taille'] . '</p>' ;
    echo '<p>' . $produit['etat'] . '</p>' ;
}
?>


</body>
</html>