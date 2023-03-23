<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=bap2;host=127.0.0.1', 'root', '');
    }

    public function getData($category, $color, $orderName, $orderDate){
        $query = 'SELECT * FROM `product`';
//======================== FILTERS ========================
        $args = 0;
        if ($category != null){
            $query .= ' WHERE category = "'.$category.'"';
            $args++;
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
            $args++;
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

    public function getSorting($filterTable){
        $query = 'SELECT title FROM '.$filterTable;
        $tableData = $this->pdo->prepare($query);
        $tableData->execute();
        return $tableData->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFilters(){
        $query = 'SHOW COLUMNS FROM bap2.products';
        $tableData = $this->pdo->prepare($query);
        $tableData->execute();
        $tableData = $tableData->fetchAll(PDO::FETCH_COLUMN, 0);
        $negativeColumns = ['id','owner_lastname','owner_firstname','owner_email','owner_phone','title','description','brand','publication'];
        foreach ($negativeColumns as $column) {
            $index = array_search($column, $tableData);
            unset($tableData[$index]);
        }
        return $tableData;
    }
}