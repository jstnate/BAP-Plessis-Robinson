<?php

require_once 'product.php';
Class Connection
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=db_plessis-robinson;host=127.0.0.1', 'root', 'root');
    }

//    ============== GET =================
    public function getCategories()
    {
        $query = "SELECT * FROM category";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getCategory($id)
    {
        $query = "SELECT title FROM category WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getColors()
    {
        $query = "SELECT * FROM color";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getColor($id)
    {
        $query = "SELECT title FROM color WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getMatters()
    {
        $query = "SELECT * FROM matter";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getMatter($id)
    {
        $query = "SELECT title FROM matter WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getStates()
    {
        $query = "SELECT * FROM state";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getState($id)
    {
        $query = "SELECT title FROM state WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getSizes()
    {
        $query = "SELECT * FROM size";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getSize($id)
    {
        $query = "SELECT title FROM size WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $produits = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $produits;
    }

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        $produit = $statement->fetch(PDO::FETCH_ASSOC);
        return $produit;
    }
//    ============== END GET =================
//    ============== INSERT =================
    public function insertProduct(Product $product): bool
    {
        $query = "INSERT INTO products (owner_lastname, owner_firstname, owner_email, owner_phone, title, description, front_pic, back_pic, side_pic, category, brand, color, matter, state, size) VALUES (:lastname,  :firstname,  :email, :phone, :title, :description, :front, :back, :side, :category, :brand, :color, :matter, :state, :size)";

        return $this->pdo->prepare($query)->execute([
            'lastname' => $product->ownerLastName,
            'firstname' => $product->ownerFirstName,
            'email' => $product->ownerEmail,
            'phone' => $product->ownerPhone,
            'title' => $product->title,
            'description' => $product->description,
            'front' => $product->front_pic,
            'back' => $product->back_pic,
            'side' => $product->side_pic,
            'category' => $product->category,
            'brand' => $product->brand,
            'color' => $product->color,
            'matter' => $product->matter,
            'state' => $product->state,
            'size' => $product->size
        ]);
    }
//    ============== END INSERT =================

public function getData($filtersArrays, $queryTitle, $sortingsArray){
    $query = 'SELECT * FROM `products`';
    $allFilters = $this->getAllFilters();
    $isFirstAnd = 0;
    $isFirstSorted = 0;

    if($filtersArrays != null) {
        $query .= ' WHERE ';

        foreach ($filtersArrays as $filterArray) {
            foreach ($allFilters as $stockedFilter) {
                if ($filterArray != null) {
                    if ($filterArray[count($filterArray) - 1] == $stockedFilter) {
                        for ($i = 0; $i < 2; $i++) {
                            unset($filterArray[count($filterArray) - 1]);
                        }
                        if ($isFirstAnd == 0) {
                            $isFirstAnd++;
                        } else {
                            $query .= ' AND ';
                        }
                        $query .= '(';
                        foreach ($filterArray as $filter) {
                            $query .= $stockedFilter . ' = "' . $filter . '"';
                            $lastArg = $filterArray[count($filterArray) - 1];
                            if ($lastArg != $filter) {
                                $query .= ' OR ';
                            }
                        }
                        $query .= ')';
                    }
                }
            }
        }
    }
    if($queryTitle != null){
        if($isFirstAnd == 0){
            $query .= ' WHERE title LIKE "%'.$queryTitle.'%"';
        }else{
            $query .= ' AND title LIKE "%'.$queryTitle.'%"';
        }
    }
    if($sortingsArray[0] != null){
        $query .= ' ORDER BY title '.$sortingsArray[0];
        $isFirstSorted++;
    }
    if($sortingsArray[1] != null){
        if($isFirstSorted == 0){
            $query .= ' ORDER BY publication '.$sortingsArray[1];
        }else{
            $query .= ', publication '.$sortingsArray[1];
        }
    }

//        return $query;
    $productData = $this->pdo->prepare($query);
    $productData->execute();
    return $productData->fetchAll(PDO::FETCH_ASSOC);
}

public function getSorting($filterTable){
    $query = 'SELECT id, title FROM ' . $filterTable;
    $tableData = $this->pdo->prepare($query);
    $tableData->execute();
    return $tableData->fetchAll(PDO::FETCH_ASSOC);
}

public function getAllFilters(){
    $query = 'SHOW COLUMNS FROM products';
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
