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
        $isWhere = 0;


        foreach($filtersArrays as $filterArray){
            foreach($allFilters as $stockedFilter){
                if($filterArray != null){
                    if($filterArray[count($filterArray)-1] == $stockedFilter){
                        for($i = 0; $i < 2; $i++){
                            unset($filterArray[count($filterArray)-1]);
                        }
                        foreach($filterArray as $filter){
                            if($isWhere == 0){
                                $query .= ' WHERE '.$stockedFilter.' = "'.$filter.'"';
                                $isWhere++;
                            }else{
                                $query .= ' OR '.$stockedFilter.' = "'.$filter.'"';
                            }
                        }
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
        $negativeColumns = ['id','owner_lastname','owner_firstname','owner_email','owner_phone','title','description','front_pic','back_pic','side_pic','brand','publication'];
        foreach ($negativeColumns as $column) {
            $index = array_search($column, $tableData);
            unset($tableData[$index]);
        }
        return $tableData;
    }
}