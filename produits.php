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
//var_dump($allFilters);
$globalFilterArray = array();
$sortings = array();
$allParameters = array();
$defaultUrl = 'produits.php';
$isFirstInDefaultUrl = 0;

foreach ($allFilters as $filter){
    array_push($allParameters, $filter);
}
array_push($allParameters,'orderN', 'orderD', 'query', 'page');

foreach ($allParameters as $parameter){
    if ($isFirstInDefaultUrl == 0) {
        $defaultUrl .= '?' . $parameter . '=';
        $isFirstInDefaultUrl++;
    } else {
        $defaultUrl .= '&' . $parameter . '=';
    }
}
$defaultUrl .= '1';

foreach ($allParameters as $parameter){
    if(!isset($_GET["$parameter"])){
        header('Location:'.$defaultUrl);
    }
}

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

if($_GET['page'] > round(count($datas)/20, 0, PHP_ROUND_HALF_UP)){
    $retrieveUrl = 'produits.php';
    $isFirstInRetrieveUrl = 0;
    $pages = round(count($datas)/20, 0, PHP_ROUND_HALF_UP);
    foreach ($allParameters as $parameter){
        if ($isFirstInRetrieveUrl == 0) {
            $retrieveUrl .= '?' . $parameter . '=' . $_GET["$parameter"];
            $isFirstInRetrieveUrl++;
        } else {
            if($parameter == 'page'){
                $retrieveUrl .= '&' . $parameter . '=' . $pages;
            }else{
                $retrieveUrl .= '&' . $parameter . '=' . $_GET["$parameter"];
            }
        }
    }
    header('Location: '.$retrieveUrl);
}

if($_GET['page'] == round(count($datas)/20, 0, PHP_ROUND_HALF_UP)){
    $displayNextButton = 0;
}else{
    $displayNextButton = 1;
}

if($_GET['page'] <= 1){
    $displayPrevButton = 0;
}else{
    $displayPrevButton = 1;
}

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
        if($_GET['page'] < round(count($datas)/20, 0, PHP_ROUND_HALF_UP)){
            $pages++;
        }
    }
    else if($_POST['prev']){
        if($pages > 1){
            $pages--;
        }
    }else{
        $pages = 1;
    }

//        echo $parameters;
    header('Location: produits.php'.$parameters.'&query='.$_POST['query'].'&orderN='.$_POST['order_name'].'&orderD='.$_POST['order_date'].'&page='.$pages);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>
<body>

<?php include 'public/layouts/_header.php'; ?>

<div>
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
                <input type="text" name="query" placeholder="Recherche" style="outline: none;width: 100%" value="<?php if(isset($_GET['query'])) echo $_GET['query'] ?>">
                <input type="submit" value="Chercher">
            </div><br>
            <div class="products-content">
                <?php
                if(intval($_GET['page']) > 0){
                    $startingIndex = ($_GET['page'] - 1) * 20;
                }else{
                    $startingIndex = 0;
                }

                for ($i = 0; $i < 20; $i++){
                    $increment = $i+$startingIndex;
                    if($increment >= count($datas)){
                        break;
                    }
                    echo '<div><a href="page_produit.php?id='.$datas[$increment]['id'].'"><img src="../images/placeholder-image.jpg" alt="placeholder">';
                    echo $datas[$increment]['title'].' - '.$connection->getFilterTitlesByID('categories',$datas[$increment]['categories'])['title'].' - '.$connection->getFilterTitlesByID('states',$datas[$increment]['states'])['title'].' - '.$connection->getFilterTitlesByID('sizes',$datas[$increment]['sizes'])['title'].' - '.$datas[$increment]['publication'].'</a></div>';
                }
                ?>
            </div>
            <div>
                <?php
                if($displayPrevButton == 1) echo '<input type="submit" name="prev" value="prev">';
                if($displayNextButton == 1) echo '<input type="submit" name="next" value="next">';
                ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'public/layouts/_footer.php'; ?>

</body>
</html>