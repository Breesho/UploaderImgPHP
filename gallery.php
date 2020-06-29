<?php
require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Gallerie - AllPix</title>
</head>

<body>
    <header class="flex">
        <h1>Galerie - AllPix</h1>
    </header>
    <div class="container-gallery flex">
        <div class="galleryformwidth">
            <div class="galleryuser">
                <?php if (isset($_SESSION['username'])) {
                    if ($_SESSION['username'] == 'superadmin') {
                ?>

                        <p>Bonjour <?= $adminArray['usernameAdmin'] ?></p>

                        <a class="accessgallery" href="dashboard.php">Dashboard</a>
            </div>
        <?php } else if ($_SESSION['username'] == 'superuser') { ?>

            <p>Bonjour <?= $userArray['usernameUser'] ?></p>

            <form method="post" action="deconnexion.php" id="form">
                <button class="" id="delete" name="killSession">Déconnexion</button>
            </form>

        <?php }
                } else { ?>

        <p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>
        <a class="accessgallery" href="index.php">Retour vers l'accueil</a>

    <?php } ?>
    <div class="flex">


        <?php foreach ($scanDir as $value) { ?>
            <div class="container-img"><a href="assets/galerie/<?= $value ?>" data-lightbox="gallery"><img src="assets/galerie/<?= $value ?>" class="galerie-img" alt=""></a></div>
        <?php } ?></div>
        </div>
    </div>
    <script src="assets/js/lightbox-plus-jquery.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
</body>

</html>