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
?>
<html>
<body>
    <form method="post">
        <input type="text"><br><br>

        <?php
        foreach ($allFilters as $filter) {
            $filterValues = $connection->getSorting($filter);
            echo $filter.'<br>';
            foreach($filterValues as $index){
                foreach($index as $value){
                    echo '<input type="checkbox" name="'.str_replace(' ','_',$value).'">'.$value.'<br>';
                }
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

    <?php

    if ($_POST){
        $parameters = '';
        $argsI = 0;
        $argsV = 0;
        foreach ($allFilters as $filter) {
            $filterValues = $connection->getSorting($filter);
            if($argsI == 0){
                $parameters .= '?'.$filter.'=';
                $argsI++;
            }else{
                $parameters .= '&'.$filter.'=';
            }
            foreach($filterValues as $index){
                foreach($index as $value){
                    if(isset($_POST[str_replace(' ','_',$value)])){
                        $parameters .= str_replace(' ','_',$value).'|';
                    }
                }
            }
        }
//        echo $parameters;
        header('Location: product.php'.$parameters);
    }
    ?>

</body>
</html>

