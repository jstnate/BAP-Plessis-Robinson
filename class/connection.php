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

    public function getColors()
    {
        $query = "SELECT * FROM colors";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getMatters()
    {
        $query = "SELECT * FROM matters";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getStates()
    {
        $query = "SELECT * FROM states";
        return $this->pdo->query($query)->fetchAll();
    }

    public function getSizes()
    {
        $query = "SELECT * FROM sizes";
        return $this->pdo->query($query)->fetchAll();
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
}