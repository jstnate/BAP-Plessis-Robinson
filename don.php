<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>don</title>
</head>
<body>

<h1>Vos coordonnées</h1>
    <form method="POST" action="traitement.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br><br>

        <label for="email">Adresse email :</label>
        <input type="email" name="email" required><br><br>

        <label for="telephone">Numéro de téléphone :</label>
        <input type="text" name="telephone" required><br><br>

        <a href="don2.php"><input type="submit" value="Passer à l'étape suivante"></a>
        

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
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $telephone = $_POST["telephone"];

            $sql = "INSERT INTO informations_personnelles (nom, prenom, email, telephone)
                    VALUES ('$nom', '$prenom', '$email', '$telephone')";

            if ($conn->query($sql) === TRUE) {
                echo "Nouvelle entrée créée avec succès.";
            } else {
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
        }
        ?>

</body>
</html>