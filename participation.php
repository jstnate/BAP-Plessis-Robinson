<?php
    require_once 'class/connection.php';

    $connection = new Connection();
    $categories = $connection->getCategories();
    $colors = $connection->getColors();
    $matters = $connection->getMatters();
    $states = $connection->getStates();
    $sizes = $connection->getSizes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="public/js/forms.js" defer></script>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Participer aux dons</title>
</head>
<body>
    <form method="POST">
        <div id="step-1" class="owner-infos">
            <label for="lastname">Nom</label>
                <input type="text" name="lastname" id="lastname" placeholder="Nom">
            <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" placeholder="Prénom">
            <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
            <label for="phone">Téléphone</label>
                <input type="tel" name="phone" id="phone" placeholder="Téléphone">

            <button type="button" value="1" id="step">Passer à l'étape suivante</button>
        </div>

        <div id="step-2" class="product-infos" style="display: none">
            <label for="title">Titre du produit</label>
                <input type="text" name="title" id="title" placeholder="Titre du produit">
            <label for="description">Description du produit</label>
                <textarea name="description" id="description" cols="30"></textarea>

            <button type="button" value="2" id="step">Passer à l'étape suivante</button>
        </div>

        <div id="step-3" class="product-details" style="display: none">
            <select name="category">
                <?php
                foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endforeach;
                ?>
            </select>

            <label for="brand">Marque</label>
                <input type="text" name="brand" id="marque" placeholder="Marque">

            <select name="color">
                <?php
                foreach ($colors as $color) : ?>
                    <option value="<?= $color['id'] ?>"><?= $color['title'] ?></option>
                <?php endforeach;
                ?>
            </select>
            <select name="matter">
                <?php
                foreach ($matters as $matter) : ?>
                    <option value="<?= $matter['id'] ?>"><?= $matter['title'] ?></option>
                <?php endforeach;
                ?>
            </select>
            <select name="state">
                <?php
                foreach ($states as $state) : ?>
                    <option value="<?= $state['id'] ?>"><?= $state['title'] ?></option>
                <?php endforeach;
                ?>
            </select>
            <select name="size">
                <?php
                foreach ($sizes as $size) : ?>
                    <option value="<?= $size['id'] ?>"><?= $size['title'] ?></option>
                <?php endforeach;
                ?>
            </select>

            <button type="submit">Effectuer mon don !</button>
        </div>
    </form>
</body>
</html>
