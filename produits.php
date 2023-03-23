<?php
    require_once 'class/connection.php';
    $connection = new Connection();
    $products = $connection->getAllProducts();

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
            $category = $connection->getSorting('categories');
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
            $color = $connection->getSorting('colors');
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

        foreach ($products as $product) :
            $category = $connection->getCategory($product['id']);
            $state = $connection->getState($product['id']);
            $size = $connection->getSize($product['id']);
        ?>
            <a href="page_produit.php?id=<?= $product['id'] ?>">
                <img src="images/uploads//products/<?= $product['front_pic'] ?>" alt="front pic">
            </a>
            <!-- <div class="image_slider">
                <img src="<?= $product['front'] ?>" alt="front pis">
                <img src="<?= $product['back'] ?>" alt="back pic">
                <img src="<?= $product['side'] ?>" alt="side pic">
            </div> -->
            <h2><?= $product['title'] ?></h2>
            <p><?= date("d/m/Y", strtotime($product['publication'])) ?></p>
            <p><?= $category['title'] ?></p>
            <p><?= $state['title'] ?></p>
            <p><?= $size['title'] ?></p> 

        <?php endforeach;
    ?>


</body>
</html>