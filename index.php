<?php

$message = ' ';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $noUpload = false;
    $allowed = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png');

    // ---------- VERSION finfo



    // if ($_FILES['file']['error'] == 4) {
    //     $message = 'Aucun fichier sélectionné, veuillez en sélectionner un.';
    // } else {
    //     $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    //     $detected_type = finfo_file($fileInfo, $_FILES['file']['tmp_name']);
    //     if (!in_array($detected_type, $allowed)) {
    //         $message = 'Votre format de fichier n\'est pas conforme. Fichier autorisé : JPG/JPEG/GIF/PNG';
    //     } else {
    //         if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

    //             $filename = $_FILES['file']['name'];
    //             $filetype = $_FILES['file']['type'];
    //             $filesize = $_FILES['file']['size'];

    //             $ext = pathinfo($filename, PATHINFO_EXTENSION);
    //             $maxsize = 1024 * 1024;
    //             if ($filesize > $maxsize) {
    //                 $noUpload = true;
    //                 $message = 'Votre fichier est trop lourd, la taille maximale autorisée est de 1Mo.';
    //             } else if (in_array($filetype, $allowed) && !$noUpload) {
    //                 move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/' . uniqid() . '.' . $ext);
    //                 $message = 'Votre fichier a été téléchargé avec succès.';
    //             } else {
    //                 $message = 'Votre fichier n\'a pas été téléchargé. Veuillez réessayer.';
    //             }
    //         } else {
    //             $message = 'Error: ' . $_FILES['file']['error'];
    //         }
    //     }
    // }




    // ---------- VERSION mime_content_type




    if ($_FILES['file']['error'] == 4) {
        $message = 'Aucun fichier sélectionné, veuillez en sélectionner un.';
    } else {
        $filetmpname = $_FILES['file']['tmp_name'];
        $filemime = mime_content_type($filetmpname);
        if (in_array($filemime, $allowed)) {

            if (isset($_FILES["file"]) && $_FILES['file']['error'] == 0) {

                $filename =  $_FILES['file']['name'];
                $filetype = $_FILES['file']['type'];
                $filesize = $_FILES['file']['size'];
                $filestmp = $_FILES['file']['tmp_name'];
                $fileserror = $_FILES['file']['error'];
                $extension = pathinfo($filename, PATHINFO_EXTENSION);

                $sizeUpload = 3 * 1024 * 1024;
                if ($filesize > $sizeUpload) {
                    $message = 'Votre fichier est trop lourd, la taille maximale autorisée est de 1Mo.';
                } else if (in_array($filetype, $allowed)) {
                    move_uploaded_file($filestmp, 'assets/img/' . uniqid() . '.' .  $extension);
                    $message = 'Votre fichier a été téléchargé avec succès.';
                } else {
                    $message = 'Votre fichier n\'a pas été téléchargé. Veuillez réessayer.';
                }
            } else {
                $message = 'Error: ' . $_FILES['file']['error'];
            }
        } else {
            $message = 'Votre format de fichier n\'est pas conforme. Fichier autorisé : JPG/JPEG/GIF/PNG';
        }
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
        <div class="col-4 col-sm-12 text-center">
            <div>
                <img class="preview mx-auto">
            </div>

            <div>
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" id="file" data-preview=".preview" class="btn btn-outline-dark">
                    <input type="submit" value="Upload" class="btn btn-outline-dark">
                </form>
            </div>

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