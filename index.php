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
    <title>Connexion</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container-fluid">
            <h1 class="display-4">Connexion - AllPix</h1>
        </div>
    </div>

    <div class="container-fluid">
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'Utilisateur :</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                
            </div>
            <div class="form-group">
                <label for="password">Mot de Passe :</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <span class="highlightError"><?= (isset($error['password'])) ? $error['password'] : '' ?></span>
            <button type="submit" name="submit" class="btn btn-outline-dark">Se Connecter</button>
        </form>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>