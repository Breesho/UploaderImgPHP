<?php 

var_dump($_FILES);

if (isset($_FILES['file'])) {
    $arrayType = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $pathInfoImg = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if (!array_key_exists($pathInfoImg, $arrayType)) {
        $message = 'Le format du fichier n\'est pas conforme';
    } else if (array_key_exists($pathInfoImg, $arrayType) > 1000000) {
        $message = 'Votre fichier est trop lourd, la taille maximale est de 1Mo';
    } else {
        $message = 'Votre image a bien été uploadée';
    }
    if (!in_array($_FILES['file']['name'], $arrayType)) {
        $message = 'Votre fichier est non-conforme';
    }
} else {
    $message = 'Choissisez une image';
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