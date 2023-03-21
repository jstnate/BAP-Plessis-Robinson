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
            <option value="lol">lol</option>
            <option value="lel">lel</option>
            <option value="lul">lul</option>
        </select>
        <select name="colors">
            <option value="">-colors-</option>
            <option value="red">red</option>
            <option value="blue">blue</option>
            <option value="green">green</option>
        </select>
        <p>Name</p>
        <input type="radio" name="order_name" value="DESC" checked>DESC
        <input type="radio" name="order_name" value="ASC">ASC
        <p>Date</p>
        <input type="radio" name="order_date" value="DESC" checked>DESC
        <input type="radio" name="order_date" value="ASC">ASC
        <p></p>
        <input type="submit" value="Search">
    </form>

    <?php

    if ($_POST){
        echo "lo";
        header('Location: product.php?cat='.$_POST['category'].'&col='.$_POST['colors'].'&ordN='.$_POST['order_name'].'&ordD='.$_POST['order_date']);
    }
    ?>

</body>
</html>

