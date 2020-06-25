<?php
require_once 'my-config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
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
                    <div>
                        <!-- Galerie -->
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
                    <div>
                        <!-- Galerie -->
                    </div>
                    <a class="btn btn-outline-dark" href="dashboard.php">Déconnexion</a>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="container-fluid">
            <div class="col-4 col-sm-12 text-center">
                <div>
                    <p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>