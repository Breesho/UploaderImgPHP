<?php
require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>AllPix - Connexion</title>
</head>

<body>

    <header class="flex">
        <h1>Connexion - AllPix</h1>
    </header>
    <div class="container-registerform flex">
        <form method="POST" action="" class="register-form">
            <div class="container-input">
                <input type="text" class="register-input" name="username" id="username" placeholder="Nom D'utilisateur" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
            </div>
            <div class="container-input">
                <input type="password" class="register-input" name="password" placeholder="Mot de passe" id="password">
            </div>
            <div class="container-input">
                <span class="register-error"><?= (isset($error['password'])) ? $error['password'] : '' ?></span>
            </div>
            <div class="container-register-submit">
                <button type="submit" name="submit" class="register-submit" class="">Connexion</button>
            </div>
        </form>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>