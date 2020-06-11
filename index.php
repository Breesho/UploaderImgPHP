<?php
$message = ' ';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noUpload = false;

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowed = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png');
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];


        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $message = 'Le format du fichier n\'est pas conforme';
        } else {
            $maxsize = 1024 * 1024;
            if ($filesize > $maxsize) {
                $noUpload = true;
                $message = 'Votre fichier est trop lourd, la taille maximale est de 1Mo';
            } else if (in_array($filetype, $allowed) && !$noUpload) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists('assets/img/' . $_FILES['file']['name'])) {
                    $message = $_FILES['file']['name'] . ' existe déjà.';
                } else {
                    move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/' . uniqid() . $_FILES['file']['name']);
                    $message = 'Votre fichier a été téléchargé avec succès.';
                }
            } else {
                $message = 'Votre fichier n\'a pas été téléchargé';
            }
        }
    } else {
        $message = 'Error: ' . $_FILES['file']['error'];
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>UploaderImg</title>
</head>

<body>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">TP - PHP</h1>
        </div>
    </div>



    <div class="container-fluid">
        <div class="col-4 col-sm-12">
            <div>
                <img class="preview">
            </div>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="file" data-preview=".preview">
                <input type="submit" value="Upload">
            </form>

            <div>
                <p><?= $message ?></p>
            </div>
        </div>
        <div class="col-8 col-sm-12">

        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>