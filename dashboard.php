<?php
require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container-fluid">
            <h1 class="display-4">Espace Membre - AllPix</h1>
        </div>
    </div>

    <?php if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == 'superadmin') {
    ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Bonjour <?= $adminArray['usernameAdmin'] ?></p>
                        <p>Quota : <?= round(TailleDossier('assets/img/') / 1000000) ?> Mo / 50 Mo</p>
                    </div>
                    <div>
                        <img class="preview mx-auto">
                    </div>
                    <div>
                        <form action="dashboard.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="file" id="file" data-preview=".preview" class="btn btn-outline-dark">
                            <input type="submit" name="submitUpload" value="Upload" class="btn btn-outline-dark">
                        </form>
                    </div>

                    <div>
                        <p><?= $message ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-outline-dark" href="gallery.php">Galerie</a>
                    <form method="post" action="deconnexion.php" id="form">
                        <button class="btn btn-outline-dark" id="delete" name="killSession">Déconnexion</button>
                    </form>
                </div>
            </div>
        <?php } else if ($_SESSION['username'] == 'superuser') { ?>
            <div class="container-fluid">
                <div class="col-4 col-sm-12 text-center">
                    <div>
                        <p>Vous n'avez pas les droits requis pour accéder à cette page</p>
                    </div>
                    <a class="btn btn-outline-dark" href="gallery.php">Retour vers la galerie</a>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container-fluid">
            <div class="col-4 col-sm-12 text-center">
                <div>
                    <p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>
                </div>
                <a class="btn btn-outline-dark" href="index.php">Retour à l'accueil</a>
            </div>
        </div>
    <?php } ?>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>