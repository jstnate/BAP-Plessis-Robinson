<?php
require_once 'connection.php';

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

//var_dump($globalFilterArray);
$datas = $connection->getData($globalFilterArray, (isset($_GET['query'])) ? ($_GET['query']) : (null), $sortings);

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
    header('Location: product.php' . $parameters . '&query=' . $_POST['query'] . '&orderN=' . $_POST['order_name'] . '&orderD=' . $_POST['order_date']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./styles/build.css">
    <title>Document</title>
</head>
<body>
<form method="post">
    <input type="text" name="query"><br><br>

    <div class="sidenav">
        <div class="filters">
            <?php
            foreach ($allFilters as $filter) {
                $filterValues = $connection->getSorting($filter);
                echo '<div><h4>'.$filter.'</h4>';
                foreach($filterValues as $index){
                    echo '<p><input type="checkbox" name="'.str_replace(' ','_',$index['title']).'">'.$index['title'].'</p>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <div class="sorting">
            <div>
                <h4>Name</h4>
                <p><input type="radio" name="order_name" value="DESC">DESC</p>
                <p><input type="radio" name="order_name" value="ASC">ASC</p>
                <p><input type="radio" name="order_name" value="" checked>None</p>
            </div>
            <div>
                <h4>Date</h4>
                <p><input type="radio" name="order_date" value="DESC">DESC</p>
                <p><input type="radio" name="order_date" value="ASC">ASC</p>
                <p><input type="radio" name="order_date" value="" checked>None</p>
            </div>
        </div>
<!--        <input type="submit" value="Search">-->
    </div>
    <div class="main">
        <?php
        foreach ($datas as $data){
            echo $data['owner_email'].' - '.$data['title'].' - '.$data['description'].' - '.$data['categories'].' - '.$data['colors'].' - '.$data['matters'].' - '.$data['states'].' - '.$data['sizes'].' - '.$data['publication'].'<br>';
        }
        ?>
    </div>

</form>

</body>
</html>