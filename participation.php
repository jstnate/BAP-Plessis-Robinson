<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Participer aux dons</title>
</head>
<body>
    <form method="POST">
        <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" placeholder="Nom">
        <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" placeholder="Prénom">
        <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email">
        <label for="phone">Téléphone</label>
            <input type="tel" name="phone" id="phone" placeholder="Téléphone">
        <button type="submit">Passer à l'étape suivant</button>
    </form>
    <form method="POST">
        <label for="title">Titre du produit</label>
            <input type="text" name="title" id="title" placeholder="Titre du produit">
        <label for="description">Description du produit</label>
            <textarea name="description" id="description" cols="30"></textarea>
        <button type="submit">Passer à l'étape suivante</button>
    </form>
    <form method="POST">
        <select>
            <option value="sweat">Sweat</option>
            <option value="t-shirt">T-shirt</option>
            <option value="pantalon">Pantalon</option>
            <option value="t-shirt">Short</option>
        </select>
        <label for="brand">Marque</label>
            <input type="text" name="marque" id="marque" placeholder="Marque">

        <select>
            <option value="bleu">Bleu</option>
            <option value="rouge">Rouge</option>
            <option value="vert">Vert</option>
            <option value="jaune">Jaune</option>
        </select>
        <select>
            <option value="laine">Laine</option>
            <option value="suédin">Suédin</option>
            <option value="coton">Coton</option>
            <option value="jean">Jean</option>
        </select>
        <select>
            <option value="parfait état">Parfait état</option>
            <option value="très bon état">Très bon état</option>
            <option value="bon état">Bon état</option>
            <option value="état correcte">Etat correcte</option>
        </select>
        <select>
            <option value="xs">XS</option>
            <option value="s">S</option>
            <option value="m">M</option>
            <option value="l">L</option>
            <option value="xl">XL</option>
        </select>

        <button type="submit">Effectuer mon don !</button>
    </form>
</body>
</html>