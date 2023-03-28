<?php
    require_once 'class/connection.php';
    require_once 'class/product.php';

    $connection = new Connection();

//    ==================== GET =================
    $categories = $connection->getCategories();
    $colors = $connection->getColors();
    $matters = $connection->getMatters();
    $states = $connection->getStates();
    $sizes = $connection->getSizes();
//    ==================== END GET =================

// ==================== INSERT =================
    if ($_POST) :

        $sku = uniqid();
        

        $product = new Product(
            $_POST['lastname'],
            $_POST['firstname'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['title'],
            $_POST['description'],
            '' . $sku .'-' . $_FILES['front_pic']['name'],
            '' . $sku .'-' . $_FILES['back_pic']['name'],
            '' . $sku .'-' . $_FILES['side_pic']['name'],
            $_POST['category'],
            $_POST['brand'],
            $_POST['color'],
            $_POST['matter'],
            $_POST['state'],
            $_POST['size']
        );

        foreach (['front_pic', 'back_pic', 'side_pic'] as $key) {
            $img_name = '' . $sku .'-' . $_FILES[$key]['name'];
            $tmp_img_name = $_FILES[$key]['tmp_name'];
            $temporary = 'images/uploads/products/';
            move_uploaded_file($tmp_img_name,$temporary.$img_name);
        }
        
        $insert = $connection->insertProduct($product);
        
    endif;
// ==================== END INSERT =================
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
    <script src="https://kit.fontawesome.com/b050931f68.js" crossorigin="anonymous"></script>
    <title>Participer aux dons</title>
</head>
<body class="participation">

    <main class="participation__content">
        <aside class="participation__content__banner">
            <h1>
                Faîtes le bon geste !
            </h1>
            <p>
                Remplissez les champs requis pour effectuer votre don
            </p>
        </aside>
        <form class="participation__content__form" method="POST" enctype="multipart/form-data" <?php if (isset($insert) && $insert) echo 'style="display: none;"' ?> >
            <fieldset id="step-1" class="participation__content__form__div participation__content__form__owner" style="display: flex;">
                <header>
                    <h2>Vos coordonnées</h2>
                    <p>Veuillez renseigner cos coordonnées pour que les potentiels intéressés puisses vous contacter</p>
                </header>

                <section>
                    <div class="civil">
                        <div>
                            <label for="lastname">Nom</label>
                            <input type="text" name="lastname" id="lastname">
                        </div>
                        <div>
                            <label for="firstname">Prénom</label>
                            <input type="text" name="firstname" id="firstname">
                        </div>
                    </div>

                    <div>
                        <label for="email">Email*</label>
                        <input type="email" name="email" class="required-1" required>
                    </div>
                    <div>
                        <label for="phone">Téléphone*</label>
                        <input type="tel" name="phone" class="required-1" required>
                    </div>
                </section>

                <button type="button" value="1" id="submit-1" disabled>Passer à l'étape suivante</button>
            </fieldset>

            <fieldset id="step-2" class="participation__content__form__div participation__content__form__products" style="display: none;">
                <header>
                    <h2>Informations Principales</h2>
                    <p>Veuillez renseigner les informations principales du produit dont vous souhaitez faire don</p>
                </header>

                <section>
                    <div>
                        <label for="title">Titre du produit*</label>
                        <input type="text" name="title" class="required-2" id="title" required>
                    </div>
                    <div class="textarea">
                        <label for="description">Description du produit*</label>
                        <textarea name="description" class="required-2" id="description" cols="30" required></textarea>
                    </div>
                </section>

                <button type="button" value="2" id="submit-2" disabled>Passer à l'étape suivante</button>
            </fieldset>

            <fieldset id="step-3" class="participation__content__form__div participation__content__form__details" style="display: none;">
                <header>
                    <h2>Informations Principales</h2>
                    <p>Veuillez renseigner les informations principales du produit dont vous souhaitez faire don</p>
                </header>
                <section>
                    <div>
                        <div>
                            <label for="category">Catégorie*</label>
                            <select name="category" class="required-3" id="category" required>
                                <?php
                                foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="brand">Marque</label>
                            <input type="text" name="brand" id="brand">
                        </div>

                    </div>

                    <div>
                        <div>
                            <label for="color">Couleur*</label>
                            <select name="color" class="required-3" id="color" required>
                                <?php
                                    foreach ($colors as $color) : ?>
                                        <option value="<?= $color['id'] ?>"><?= $color['title'] ?></option>
                                    <?php endforeach;
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="matter">Matière*</label>
                            <select name="matter" id="matter">
                                <?php
                                foreach ($matters as $matter) : ?>
                                    <option value="<?= $matter['id'] ?>"><?= $matter['title'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="state">Etat*</label>
                            <select name="state" class="required-3" id="state" required>
                                <?php
                                foreach ($states as $state) : ?>
                                    <option value="<?= $state['id'] ?>"><?= $state['title'] ?></option>
                                <?php endforeach;
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="size">Taille*</label>
                            <select name="size" class="required-3" id="size" required>
                                <?php
                                    foreach ($sizes as $size) : ?>
                                        <option value="<?= $size['id'] ?>"><?= $size['title'] ?></option>
                                    <?php endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="dropbox">
                        <label class="file-drop-zone" id="front-dropbox" for="front">
                            <h3>Photo de face*</h3>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span class="file-name" id="front-file-name"></span>
                            <span class="file-message">.jpg, .png, .jpeg</span>
                        </label>
                        <input type="file" name="front_pic" id="front" class="required-3" accept="image/png, image/jpeg, image/jpg" required>

                        <label class="file-drop-zone" id="back-dropbox" for="back">
                            <h3>Photo de profil*</h3>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span class="file-name" id="back-file-name"></span>
                            <span class="file-message">.jpg, .png, .jpeg</span>
                        </label>
                        <input type="file" name="back_pic" id="back" class="required-3" accept="image/png, image/jpeg, image/jpg" required>


                        <label class="file-drop-zone" id="side-dropbox" for="side">
                            <h3>Photo de dos*</h3>
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span class="file-name" id="side-file-name"></span>
                            <span class="file-message">.jpg, .png, .jpeg</span>
                        </label>
                        <input type="file" name="side_pic" id="side" class="required-3" accept="image/png, image/jpeg, image/jpg" required>
                    </div>
                </section>

                <button type="submit" id="submit-3" disabled>Effectuer mon don !</button>
            </fieldset>
        </form>
        <?php if (isset($insert) && $insert) { ?>
            <section class="participation__content__results">
                <h2>Votre don à bien était enregistré</h2>
                <p>Les autres utilisateurs peuvent désormais le voir sur la page des objets donnés</p>
                <a href="participation.php">Effectuer un autre don</a>
            </section>
        <?php } ?> 
    </main>

</body>
</html>
