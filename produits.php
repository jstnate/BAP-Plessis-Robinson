<?php
    require_once 'class/connection.php';
    $connection = new Connection();
    $produits = $connection->getAllProducts();

    $connection = new Connection();
    $data = $connection->getData(
        (isset($_GET['cat'])) ? ($_GET['cat']) : (null),
        (isset($_GET['col'])) ? ($_GET['col']) : (null),
        (isset($_GET['ordN'])) ? ($_GET['ordN']) : (null),
        (isset($_GET['ordD'])) ? ($_GET['ordD']) : (null));
        
    if ($_POST){
        header('Location: product.php?cat='.$_POST['category'].'&col='.$_POST['colors'].'&ordN='.$_POST['order_name'].'&ordD='.$_POST['order_date']);
    }
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
    <form method="post">
        <select name="category">
            <option value="">-category-</option>
            <?php
            $category = $connection->getSorting('category');
            foreach($category as $index){
                foreach($index as $value){
                    echo '<option value="'.$value.'">'.$value.'</option>';
                }
            }
            ?>
        </select>
        <select name="colors">
            <option value="">-colors-</option>
            <?php
            $color = $connection->getSorting('color');
            foreach($color as $index){
                foreach($index as $value){
                    echo '<option value="'.$value.'">'.$value.'</option>';
                }
            }
            ?>
        </select>
        <p>Name</p>
        <input type="radio" name="order_name" value="DESC">DESC
        <input type="radio" name="order_name" value="ASC">ASC
        <input type="radio" name="order_name" value="" checked>None
        <p>Date</p>
        <input type="radio" name="order_date" value="DESC">DESC
        <input type="radio" name="order_date" value="ASC">ASC
        <input type="radio" name="order_date" value="" checked>None
        <p></p>
        <input type="submit" value="Search">
    </form>
    
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