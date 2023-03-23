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

    public function getData($category, $color, $orderName, $orderDate){
        $query = 'SELECT * FROM `products`';
    //======================== FILTERS ========================
        $args = 0;
        if ($category != null){
            $query .= ' WHERE categories = "'.$category.'"';
            $args++;
        }
        //============== FILTER TILE ================= repeat the tile and change the filter to add one
        if ($color != null){
            if($args == 0){
                $query .= ' WHERE colors = "'.$color.'"';
                $args++;
            }else{
                $query .= ' AND colors = "'.$color.'"';
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

    public function getSorting($column){
        $query = 'SELECT * FROM '.$column.'';
        $columnData = $this->pdo->prepare($query);
        $columnData->execute();
        return $columnData->fetchAll(PDO::FETCH_ASSOC);
    }
}
