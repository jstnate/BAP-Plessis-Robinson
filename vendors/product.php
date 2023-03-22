<?php
require_once 'connection.php';

$connection = new Connection();
$data = $connection->getData(
    (isset($_GET['cat'])) ? ($_GET['cat']) : (null),
    (isset($_GET['col'])) ? ($_GET['col']) : (null),
    (isset($_GET['ordN'])) ? ($_GET['ordN']) : (null),
    (isset($_GET['ordD'])) ? ($_GET['ordD']) : (null));
var_dump($data);
//echo '<a href="product?cat=&col=&ordN=DESC&ordD=DESC"</a><br>';
?>
<html>
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

    if ($_POST){
        header('Location: product.php?cat='.$_POST['category'].'&col='.$_POST['colors'].'&ordN='.$_POST['order_name'].'&ordD='.$_POST['order_date']);
    }
    ?>

</body>
</html>

