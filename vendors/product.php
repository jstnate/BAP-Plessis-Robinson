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
        <select name="colors">
            <option value="">-colors-</option>
            <option value="red">red</option>
            <option value="blue">blue</option>
            <option value="green">green</option>
        </select>
        <select name="category">
            <option value="">-category-</option>
            <option value="red">lol</option>
            <option value="blue">lel</option>
            <option value="green">lul</option>
        </select>
        <p>Name</p>
        <input type="radio" name="order_name" value="DESC">DESC
        <input type="radio" name="order_name" value="ASC">ASC
        <p>Date</p>
        <input type="radio" name="order_date" value="DESC">DESC
        <input type="radio" name="order_date" value="ASC">ASC
    </form>
</body>
</html>

