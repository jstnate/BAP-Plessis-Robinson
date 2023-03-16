<?php

require_once 'product.php';
Class Connection
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=db_plessis-robinson;host=127.0.0.1', 'root', 'root');
    }
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
}