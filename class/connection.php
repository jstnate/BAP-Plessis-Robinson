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
        $query = "SELECT * FROM categories";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getCategory($id)
    {
        $query = "SELECT title FROM categories WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getColors()
    {
        $query = "SELECT * FROM colors";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getColor($id)
    {
        $query = "SELECT title FROM colors WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getMatters()
    {
        $query = "SELECT * FROM matters";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getMatter($id)
    {
        $query = "SELECT title FROM matters WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getStates()
    {
        $query = "SELECT * FROM states";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getState($id)
    {
        $query = "SELECT title FROM states WHERE id = $id";
        return $this->pdo->query($query)->fetch();
    }

    public function getSizes()
    {
        $query = "SELECT * FROM sizes";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getSize($id)
    {
        $query = "SELECT title FROM sizes WHERE id = $id";
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
        $query = "INSERT INTO products (owner_lastname, owner_firstname, owner_email, owner_phone, title, description, front_pic, back_pic, side_pic, categories, brand, colors, matters, states, sizes) VALUES (:lastname,  :firstname,  :email, :phone, :title, :description, :front, :back, :side, :category, :brand, :color, :matter, :state, :size)";

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

        $productData = $this->pdo->prepare($query);
        $productData->execute();
        return $productData->fetchAll(PDO::FETCH_ASSOC);
//        return $query;
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

    public function getFilterTitlesByID($filterTable, $filterId){
        $query = 'SELECT title FROM '.$filterTable.' WHERE id='.$filterId;
        $tableData = $this->pdo->prepare($query);
        $tableData->execute();
        return $tableData->fetch(PDO::FETCH_ASSOC);
    }
}
