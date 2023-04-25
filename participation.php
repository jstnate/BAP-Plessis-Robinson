<?php
    // Include necessary files and libraries
    require_once 'class/connection.php';
    require_once 'class/product.php';
    require_once __DIR__ . '/vendor/autoload.php';

    // Create a new Connection object
    $connection = new Connection();

    // Retrieve data from the database using Connection object's methods
    $categories = $connection->getCategories();
    $colors = $connection->getColors();
    $matters = $connection->getMatters();
    $states = $connection->getStates();
    $sizes = $connection->getSizes();

    // Handle form submission and insert product into the database
    if ($_POST) :

        // Generate a unique identifier for the product
        $sku = uniqid();

        // Create a new Product object with data submitted through the form
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

        // Upload the product images to the server
        foreach (['front_pic', 'back_pic', 'side_pic'] as $key) {
            $img_name = '' . $sku .'-' . $_FILES[$key]['name'];
            $tmp_img_name = $_FILES[$key]['tmp_name'];
            $temporary = 'images/uploads/products/';
            move_uploaded_file($tmp_img_name,$temporary.$img_name);
        }

        // Insert the new product into the database using Connection object's method
        $insert = $connection->insertProduct($product);

        // Send a thank-you email to the user who submitted the form
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];

        // Load the content of the email template
        $template = file_get_contents("email_template.html");

        // Replace placeholders in the email template with actual values
        $template = str_replace("{{ name }}", $firstname, $template);

        // Set the email sender address (you can use your own email address)
        $from = "noreply@plessis.com";

        // Set the email subject
        $subject = "Thank you for your submission!";

        // To send an HTML email, set the content-type and character set
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: $from" . "\r\n";

        // Send the email with the HTML template
        if (mail($email, $subject, $template, $headers)) {
            // echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }

    endif;
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

    <?php include 'public/layouts/_header.php'; ?>

    <main class="participation__content">
    <aside class="participation__content__banner">
        <!-- The banner for the page -->
        <h1>Faîtes le bon geste !</h1>
        <p>Remplissez les champs requis pour effectuer votre don</p>
    </aside>

    <!-- Show form when not already submitted -->
    <?php if (!isset($insert)) { ?>
    <form class="participation__content__form" id="participation-form" method="POST" enctype="multipart/form-data">
        <!-- The form used to collect data from the user -->
        <fieldset id="step-1" class="participation__content__form__div participation__content__form__owner" style="display: flex;">
            <!-- Fieldset for owner information -->
            <header class="participation__content__form__div__header">
                <!-- Header section for the fieldset -->
                <h2>Vos coordonnées</h2>
                <p>Veuillez renseigner cos coordonnées pour que les potentiels intéressés puisses vous contacter</p>
            </header>
            <section>
                <!-- Section of the fieldset for related elements -->
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
            <!-- Fieldset for product information -->
            <header class="participation__content__form__div__header">
                <!-- Header section for the fieldset -->
                <h2>Informations Principales</h2>
                <p>Veuillez renseigner les informations principales du produit dont vous souhaitez faire don</p>
            </header>
            <section>
                <!-- Section of the fieldset for related elements -->
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
            <!-- Fieldset for more product details -->
            <header class="participation__content__form__div__header">
                <!-- Header section for the fieldset -->
                <h2>Informations Principales</h2>
                <p>Veuillez renseigner les informations principales du produit dont vous souhaitez faire don</p>
            </header>
            <section>
                <!-- Section of the fieldset for related elements -->
                <div>
                    <div>
                        <label for="category">Catégorie*</label>
                        <select name="category" class="required-3" id="category" required>
                            <!-- Looping through the categories from the database to show as options -->
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                            <?php endforeach; ?>
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
                            <!-- Looping through the colors from the database to show as options -->
                            <?php foreach ($colors as $color) : ?>
                                <option value="<?= $color['id'] ?>"><?= $color['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="matter">Matière*</label>
                        <select name="matter" id="matter">
                            <!-- Looping through the materials from the database to show as options -->
                            <?php foreach ($matters as $matter) : ?>
                                <option value="<?= $matter['id'] ?>"><?= $matter['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <div>
                        <label for="state">Etat*</label>
                        <select name="state" class="required-3" id="state" required>
                            <!-- Looping through the states from the database to show as options -->
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>"><?= $state['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="size">Taille*</label>
                        <select name="size" class="required-3" id="size" required>
                            <!-- Looping through the sizes from the database to show as options -->
                            <?php foreach ($sizes as $size) : ?>
                                <option value="<?= $size['id'] ?>"><?= $size['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="dropbox">
                    <!-- Three input fields for uploading photos of the item -->
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
    <?php } else if (isset($insert) && $insert) { ?>
        <!-- If the item was successfully donated, display a success message and an option to donate again -->
        <section class="participation__content__results">
            <h2>Votre don à bien était enregistré</h2>
            <p>Les autres utilisateurs peuvent désormais le voir sur la page des objets donnés</p>
            <a href="participation.php">Effectuer un autre don</a>
        </section>
    <?php } ?>
</main>
    <?php include 'public/layouts/_footer.php'; ?>

</body>
</html>
