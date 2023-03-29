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
$datas = $connection->getData($globalFilterArray, (isset($_GET['query'])) ? ($_GET['query']) : (null), $sortings, (isset($_GET['page'])) ? ($_GET['page']) : (null));

if ($_POST) {
    $parameters = '';
    $argsI = 0;
    $argsV = 0;
    $pages = $_GET['page'];
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

    if($_POST['next']){
        $pages++;
    }
    else if($_POST['prev']){
        if($pages > 1){
            $pages--;
        }
    }else{
        $pages = 1;
    }

//        echo $parameters;
    header('Location: product.php'.$parameters.'&query='.$_POST['query'].'&orderN='.$_POST['order_name'].'&orderD='.$_POST['order_date'].'&page='.$pages);
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

<div>
    <div class="navbar">
        <p>navbar</p>
    </div>
    <div class="main-content">
        <div class="sidenav">
            <form method="post">
                <div class="filters">
                    <?php
//                    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//                    echo $actual_link;
                    foreach ($allFilters as $filter) {
                        $filterValues = $connection->getSorting($filter);
                        echo '<h4>'.$filter.'</h4>';
                        foreach($filterValues as $index){
                            if(isset($_GET["$filter"]) && str_contains($_GET["$filter"],$index['id'])){
                                $persistent = ' checked';
                            }else{
                                $persistent = null;
                            }
                            echo '<p><input type="checkbox" name="'.$index['title'].'"'.$persistent.'>'.$index['title'].'</p>';
                        }
                    }
                    ?>
                    <h4>Order by Name</h4>
                    <p><input type="radio" name="order_name" value="DESC" <?php if(isset($_GET['orderN']) && $_GET['orderN'] === 'DESC') echo 'checked'; ?> >DESC</p>
                    <p><input type="radio" name="order_name" value="ASC" <?php if(isset($_GET['orderN']) && $_GET['orderN'] === 'ASC') echo 'checked'; ?> >ASC</p>
                    <p><input type="radio" name="order_name" value="" <?php if(isset($_GET['orderN']) && $_GET['orderN'] === '') echo 'checked'; ?> >None</p>
                    <h4>Order by Date</h4>
                    <p><input type="radio" name="order_date" value="DESC" <?php if(isset($_GET['orderD']) && $_GET['orderD'] === 'DESC') echo 'checked'; ?> >DESC</p>
                    <p><input type="radio" name="order_date" value="ASC" <?php if(isset($_GET['orderD']) && $_GET['orderD'] === 'ASC') echo 'checked'; ?> >ASC</p>
                    <p><input type="radio" name="order_date" value="" <?php if(isset($_GET['orderD']) && $_GET['orderD'] === '') echo 'checked'; ?> >None</p>
<!--                    <input type="submit" value="Search" style="display:none">-->
                </div>
        </div>

        <div class="products">
            <div class="searchbar">
                    <input type="text" name="query" placeholder="nom" style="outline: none;width: 100%" value="<?php if(isset($_GET['query'])) echo $_GET['query'] ?>">
                    <input type="submit" value="Chercher">
            </div><br>
            <div class="products-content">
                <?php
                foreach ($datas as $data){
                    echo '<div><img src="../images/placeholder-image.jpg" alt="placeholder">';
                    echo $data['title'].' - '.$connection->getFilterTitlesByID('categories',$data['categories'])['title'].' - '.$connection->getFilterTitlesByID('states',$data['states'])['title'].' - '.$connection->getFilterTitlesByID('sizes',$data['sizes'])['title'].' - '.$data['publication'].'</div>';
                }
                ?>
            </div>
            <div>
                <input type="submit" name="prev" value="prev">
                <input type="submit" name="next" value="next">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>