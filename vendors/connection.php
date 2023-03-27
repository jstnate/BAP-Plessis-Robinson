<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=bap2;host=127.0.0.1', 'root', '');
    }

    public function getData($filtersArrays){
        $query = 'SELECT * FROM `products`';
        $allFilters = $this->getAllFilters();
        $isFirstAnd = 0;

        if($filtersArrays != null){
            $query .= ' WHERE ';
        }

        foreach($filtersArrays as $filterArray){
            foreach($allFilters as $stockedFilter){
                if($filterArray != null){
                    if($filterArray[count($filterArray)-1] == $stockedFilter){
                        for($i = 0; $i < 2; $i++){
                            unset($filterArray[count($filterArray)-1]);
                        }
                        if($isFirstAnd == 0){
                            $isFirstAnd++;
                        }else{
                            $query .= ' AND ';
                        }
                        $query .= '(';
                        foreach($filterArray as $filter){
                            $query .= $stockedFilter.' = "'.$filter.'"';
                            $lastArg = $filterArray[count($filterArray)-1];
                            if($lastArg != $filter){
                                $query .= ' OR ';
                            }
                        }
                        $query .= ')';
                    }
                }
            }
        }
        return $query;
//        $productData = $this->pdo->prepare($query);
//        $productData->execute();
//        return $productData->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSorting($filterTable){
        $query = 'SELECT id, title FROM '.$filterTable;
        $tableData = $this->pdo->prepare($query);
        $tableData->execute();
        return $tableData->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllFilters(){
        $query = 'SHOW COLUMNS FROM bap2.products';
        $tableData = $this->pdo->prepare($query);
        $tableData->execute();
        $tableData = $tableData->fetchAll(PDO::FETCH_COLUMN, 0);
        $negativeColumns = ['id','owner_lastname','owner_firstname','owner_email','owner_phone','title','description','front_pic','back_pic','side_pic','brand','publication'];
        foreach ($negativeColumns as $column) {
            $index = array_search($column, $tableData);
            unset($tableData[$index]);
        }
        return $tableData;
    }
}