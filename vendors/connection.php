<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=bap;host=127.0.0.1', 'root', '');
    }

    public function getData($category, $color, $orderName, $orderDate){
        $query = 'SELECT * FROM `product`';
//======================== FILTERS ========================
        $args = 0;
        if ($category != null){
            $query .= ' WHERE category = "'.$category.'"';
        }
        //============== FILTER TILE ================= repeat the tile and change the filter to add one
        if ($color != null){
            if($args == 0){
                $query .= ' WHERE color = "'.$color.'"';
                $args++;
            }else{
                $query .= ' AND color = "'.$color.'"';
            }
        }
        //============== END FILTER TILE =================
//  ======================== END FILTERS ========================

//======================== SORTING ========================
        $args = 0;
        if($orderName != null){
            $query .= ' ORDER BY name '.$orderName;
        }
        //============== SORTING TILE ================= repeat the tile and change the sorting to add one
        if($orderDate != null){
            if($args == 0){
                $query .= ' ORDER BY date '.$orderDate;
                $args++;
            }else{
                $query .= ' , date '.$orderDate;
            }
        }
        //============== END SORTING TILE =================
//======================== END SORTING ========================


        $productData = $this->pdo->prepare($query);
        $productData->execute();
        return $productData->fetchAll(PDO::FETCH_ASSOC);
    }
}