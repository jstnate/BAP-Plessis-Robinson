<?php
require_once 'class/connection.php';

$connection = new Connection();
//$data = $connection->getData(
//    (isset($_GET['cat'])) ? ($_GET['cat']) : (null),
//    (isset($_GET['col'])) ? ($_GET['col']) : (null),
//    (isset($_GET['ordN'])) ? ($_GET['ordN']) : (null),
//    (isset($_GET['ordD'])) ? ($_GET['ordD']) : (null));
//var_dump($data);
//echo '<a href="product?cat=&col=&ordN=DESC&ordD=DESC"</a><br>';
$allFilters = $connection->getAllFilters();
$globalFilterArray = array();
$sortings = array();
foreach ($allFilters as $filter){
    if(isset($_GET[$filter])){
        if($_GET[$filter] != null){
            $temporaryFilterArray = explode("|", str_replace('_',' ',$_GET[$filter]));
            array_push($temporaryFilterArray, $filter);
            array_push($globalFilterArray, $temporaryFilterArray);
        }
    }
}

array_push($sortings, (isset($_GET['orderN'])) ? ($_GET['orderN']) : (null));
array_push($sortings, (isset($_GET['orderD'])) ? ($_GET['orderD']) : (null));

var_dump($globalFilterArray);
var_dump($connection->getData($globalFilterArray, (isset($_GET['query'])) ? ($_GET['query']) : (null), $sortings));

if ($_POST) {
    $parameters = '';
    $argsI = 0;
    $argsV = 0;
    foreach ($allFilters as $filter) {
        $filterValues = $connection->getSorting($filter);
        if ($argsI == 0) {
            $parameters .= '?' . $filter . '=';
            $argsI++;
        } else {
            $parameters .= '&' . $filter . '=';
        }
        foreach ($filterValues as $index) {
            if (isset($_POST[str_replace(' ', '_', $index['title'])])) {
                $parameters .= str_replace(' ', '_', $index['id']) . '|';
            }
        }
    }
//        echo $parameters;
    header('Location: produits.php' . $parameters . '&query=' . $_POST['query'] . '&orderN=' . $_POST['order_name'] . '&orderD=' . $_POST['order_date']);
}

?>
<html>
<body>
<form method="post">
    <input type="text" name="query"><br><br>

    <?php
    foreach ($allFilters as $filter) {
        $filterValues = $connection->getSorting($filter);
        echo $filter.'<br>';
        foreach($filterValues as $index){
            echo '<input type="checkbox" name="'.str_replace(' ','_',$index['title']).'">'.$index['title'].'<br>';
        }
    }
    ?>

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

</body>
</html>