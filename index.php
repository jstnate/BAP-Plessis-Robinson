<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b050931f68.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Home page</title>
</head>
<body>
    <?php include 'public/layouts/_header.php'; ?>

    <section>
        <div class="home">
            <h1>La maison des Part’Âges</h1>
            <h2>Découvrez notre projet et devenez acteur de la solidarité en contribuant à notre collecte de vêtements.</h2>
        </div>
    </section>

    <section class="btn">
        <a href="#">Donner <img src="images/kdo.png" alt="Logo cadeau"></a>
        <a href="#">Récuperer <img src="images/panier.png" alt="Logo panier"></a>
    </section>

    <section class="main">
        <div class="mainBloc1 hide">
            <img src="images/img1.png" alt="photo dessin animation">
            <div class="mainTxt">
                <h3>Le projet de la ville
                    de Le Plessis-Robinsson</h3>
                <p>Communauté solidaire et engagée dans l’écoresponsabilité, la ville s’engage avec La Maison des Part’Âges pour collecter vos vêtements et objets et les redistribuer aux personnes dans le besoin. <br><br>


                    Vous pouvez publier vos vêtements sur notre site pour qu'ils trouvent une nouvelle vie auprès d'une personne dans le besoin. Nous organisons également une ou deux bourses aux vêtements chaque année. <br>
                    Rejoignez-nous dès maintenant en cliquant sur le bouton ci-dessus pour publier vos vêtements ou en explorant notre site pour en savoir plus sur notre initiative solidaire.
                </p>
            </div>
        </div>

        <div class="mainBloc2 hide">
            <div class="mainTxt">
                <h3>Le projet de la ville
                    de Le Plessis-Robinsson</h3>
                <p>Communauté solidaire et engagée dans l’écoresponsabilité, la ville s’engage avec La Maison des Part’Âges pour collecter vos vêtements et objets et les redistribuer aux personnes dans le besoin. <br><br>


                    Vous pouvez publier vos vêtements sur notre site pour qu'ils trouvent une nouvelle vie auprès d'une personne dans le besoin. Nous organisons également une ou deux bourses aux vêtements chaque année. <br>
                    Rejoignez-nous dès maintenant en cliquant sur le bouton ci-dessus pour publier vos vêtements ou en explorant notre site pour en savoir plus sur notre initiative solidaire.
                </p>
            </div>
            <img src="images/img2.png" alt="photo dessin animation">
        </div>

        <div class="mainBloc3 hide">
            <img src="images/img3.png" alt="photo dessin animation">
            <div class="mainTxt">
                <h3>Le projet de la ville
                    de Le Plessis-Robinsson</h3>
                <p>Communauté solidaire et engagée dans l’écoresponsabilité, la ville s’engage avec La Maison des Part’Âges pour collecter vos vêtements et objets et les redistribuer aux personnes dans le besoin. <br><br>


                    Vous pouvez publier vos vêtements sur notre site pour qu'ils trouvent une nouvelle vie auprès d'une personne dans le besoin. Nous organisons également une ou deux bourses aux vêtements chaque année. <br>
                    Rejoignez-nous dès maintenant en cliquant sur le bouton ci-dessus pour publier vos vêtements ou en explorant notre site pour en savoir plus sur notre initiative solidaire.
                </p>
            </div>
        </div>
    </section>

    <?php include 'public/layouts/_footer.php'; ?>

    <script>
        window.addEventListener('scroll',function(){
            var header = document.querySelector('header');
            header.classList.toggle('sticky',window.scrollY > 0);
        });
    </script>
</body>
</html>