<?php

// Connexion à la base de données
$dsn = "mysql:host=127.0.0.1;dbname=bap2";
$username = "root";
$password = "";
$database = new Database($dsn, $username, $password);

// Classe pour la connexion à la base de données
class Database {
    private $dsn;
    private $username;
    private $password;
    public $db;

    public function __construct($dsn, $username, $password) {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        $this->db = new PDO($this->dsn, $this->username, $this->password);
        return $this->db;
    }
}

// Classe pour les produits
class Produit {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM produits";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $produits = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $produits;
    }

    public function getById($id) {
        $query = "SELECT * FROM produits WHERE id = ?";
        $statement = $this->db->prepare($query);
        $statement->execute([$id]);
        $produit = $statement->fetch(PDO::FETCH_ASSOC);
        return $produit;
    }
}


$db = $database->connect();

// Création de l'objet Produit
$produit = new Produit($db);

// Récupération de tous les produits
$produits = $produit->getAll();

?>