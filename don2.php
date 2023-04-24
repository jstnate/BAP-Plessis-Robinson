<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations principales</title>
</head>
<body>
<h1>Informations principales</h1>
    <form method="POST" action="traitement_produits.php">
        <label for="titre">Titre du produit :</label>
        <input type="text" name="titre" required><br><br>

        <label for="description">Description :</label>
        <input type="text" name="description" required><br><br>

        <label for="categorie">Catégorie :</label>
        <input type="text" name="categorie" required><br><br>

        <label for="marque">Marque :</label>
        <input type="text" name="marque" required><br><br>

        <label for="couleur">Couleur :</label>
        <input type="text" name="couleur" required><br><br>

        <label for="matiere">Matière :</label>
        <input type="text" name="matiere" required><br><br>

        <label for="etat">État :</label>
        <input type="text" name="etat" required><br><br>

        <label for="taille">Taille :</label>
        <input type="text" name="taille" required><br><br>

        <a href="don3.php"><input type="submit" value="Passer à l'étape suivante"></a>
    </form>

    <?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bap";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $categorie = $_POST["categorie"];
    $marque = $_POST["marque"];
    $couleur = $_POST["couleur"];
    $matiere = $_POST["matiere"];
    $etat = $_POST["etat"];
    $taille = $_POST["taille"];

    $sql = "INSERT INTO produits_caracteristiques (titre, description, categorie, marque, couleur, matiere, etat, taille)
    VALUES ('$titre', '$description', '$categorie', '$marque', '$couleur', '$matiere', '$etat', '$taille')";
    if ($conn->query($sql) === TRUE) {
        echo "Les données ont été ajoutées avec succès.";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
    }
    
    ?>
    

</body>
</html>