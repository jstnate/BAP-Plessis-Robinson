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
            <option value="1">Sweat</option>
            <option value="2">T-shirt</option>
            <option value="3">Pantalon</option>
            <option value="4">Short</option>
        </select>
        <label for="brand">Marque</label>
            <input type="text" name="marque" id="marque" placeholder="Marque">

        <select>
            <option value="1">Bleu</option>
            <option value="2">Rouge</option>
            <option value="3">Vert</option>
            <option value="4">Jaune</option>
        </select>
        <select>
            <option value="1">Laine</option>
            <option value="2">Suédin</option>
            <option value="3">Coton</option>
            <option value="">Jean</option>
        </select>
        <select>
            <option value="1">Parfait état</option>
            <option value="2">Très bon état</option>
            <option value="3">Bon état</option>
            <option value="4">Etat correcte</option>
        </select>
        <select>
            <option value="1">XS</option>
            <option value="2">S</option>
            <option value="3">M</option>
            <option value="4">L</option>
            <option value="5">XL</option>
        </select>

        <button type="submit">Effectuer mon don !</button>
    </form>
</body>
</html>