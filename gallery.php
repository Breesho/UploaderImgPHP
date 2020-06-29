<?php
require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Galerie</title>
</head>

<body>

    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container-fluid">
            <h1 class="display-4">Galerie - AllPix</h1>
        </div>
    </div>

    <?php if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == 'superadmin') {
    ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Bonjour <?= $adminArray['usernameAdmin'] ?></p>
                    </div>
                    <a class="btn btn-outline-dark" href="dashboard.php">Dashboard</a>
                </div>

            </div>
        <?php } else if ($_SESSION['username'] == 'superuser') { ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Bonjour <?= $userArray['usernameUser'] ?></p>
                    </div>
                    <form method="post" action="deconnexion.php" id="form">
                        <button class="btn btn-outline-dark" id="delete" name="killSession">Déconnexion</button>
                    </form>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container-fluid">
            <div class="col-4 col-sm-12 text-center">
                <div>
                    <p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>
                </div>
                <a class="btn btn-outline-dark" href="index.php">Retour vers l'accueil</a>
            </div>
        </div>
    <?php } ?>

    <div>
        <?php foreach ($scanDir as $value) { ?>
            <a href="assets/galerie/<?= $value ?>" data-lightbox="gallery"><img src="assets/galerie/<?= $value ?>" width="250px" height="250px" alt=""></a>
        <?php } ?>
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