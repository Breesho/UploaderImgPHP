<?php
    require_once 'assets/php/my-config.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard - AllPix</title>
</head>

<body>
    <header class="flex">
        <h1>Dashboard - AllPix</h1>
    </header>


    <div class="container-dashboard flex">
        <div class="dashboard">
        <?php if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] == 'superadmin') {
        ?>
                <div>
                    <p>Bonjour <?= $adminArray['usernameAdmin'] ?></p>
                    <p>Quota : <?= round(TailleDossier('assets/galerie/') / 1000000) ?> Mo / 50 Mo</p>
                </div>
                <div>
                    <img id="imgpreview">
                </div>
                <div>
                    <form action="dashboard.php" method="post" enctype="multipart/form-data">
                   
                        <input type="file" name="file" id="fileToUpload" data-preview="#preview" class="">
                    
                        <input type="submit" id="submitUpload" name="submitUpload" value="Upload" class="">
                      
                    </form>
                </div>

                <div>
                    <p><?= $message ?></p>
                </div>

<div>
<a id="accessgallery" href="gallery.php">Galerie</a>
</div>
              
                <form method="post" action="deconnexion.php" id="form">
                    <button class="" id="delete" name="killSession">Déconnexion</button>
                </form>
    </div>
    </div>
<?php } else if ($_SESSION['username'] == 'superuser') { ?>

    <p>Vous n'avez pas les droits requis pour accéder à cette page</p>

    <a class="" href="gallery.php">Retour vers la galerie</a>

<?php }
        } else { ?>

<p>Pour accéder à cette page, vous devez obligatoirement vous connecter</p>

<a class="" href="index.php">Retour à l'accueil</a>

<?php } ?>
</div>
</div>



<script src="assets/js/script.js"></script>
</body>

</html>