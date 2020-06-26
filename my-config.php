<?php
session_start();

$tailleDossier = 50000000;
$maxsize = 6 * 1024 * 1024;

/* ---------- Vérifications pour l'upload d'image ---------- */
$message = ' ';


if (isset($_POST['submitUpload'])) {
    $noUpload = false;
    $allowed = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png');

    // ---------- VERSION finfo

    if ($_FILES['file']['error'] == 4) {
        $message = 'Aucun fichier sélectionné, veuillez en sélectionner un.';
    } else {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detected_type = finfo_file($fileInfo, $_FILES['file']['tmp_name']);
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        if (!in_array($detected_type, $allowed)) {
            $message = 'Votre format de fichier n\'est pas conforme. Fichier autorisé : JPG/JPEG/GIF/PNG';
        } else {
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if ($filesize > $maxsize) {
                    $noUpload = true;
                    $message = 'La taille de l\'image est supérieure à 1 Mo (' . round($filesize  / 1000000) .  ' Mo) , veuillez réessayer';
                } else if (TailleDossier('assets/img/') + $filesize > $tailleDossier) {
                    $noUpload = true;
                    $message = 'La taille maximale du dossier a été atteinte';
                } else if (in_array($filetype, $allowed) && !$noUpload) {
                    move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/' . uniqid() . '.' . $ext);
                    $message = 'Votre fichier a été téléchargé avec succès.';
                } else {
                    $message = 'Votre fichier n\'a pas été téléchargé. Veuillez réessayer.';
                }
            } else {
                $message = 'Error: ' . $_FILES['file']['error'];
            }
        }
    }




    // ---------- VERSION mime_content_type

    // if ($_FILES['file']['error'] == 4) {
    //     $message = 'Aucun fichier sélectionné, veuillez en sélectionner un.';
    // } else {
    //     $filetmpname = $_FILES['file']['tmp_name'];
    //     $filemime = mime_content_type($filetmpname);
    //     if (in_array($filemime, $allowed)) {

    //         if (isset($_FILES["file"]) && $_FILES['file']['error'] == 0) {

    //             $filename =  $_FILES['file']['name'];
    //             $filetype = $_FILES['file']['type'];
    //             $filesize = $_FILES['file']['size'];
    //             $filestmp = $_FILES['file']['tmp_name'];
    //             $fileserror = $_FILES['file']['error'];
    //             $extension = pathinfo($filename, PATHINFO_EXTENSION);

    //             $sizeUpload = 3 * 1024 * 1024;
    //             if ($filesize > $sizeUpload) {
    //                 $message = 'La taille de l\'image est supérieure à 1 Mo (' . round($filesize  / 1000000) .  ' Mo) , veuillez réessayer';
    //             } else if (in_array($filetype, $allowed)) {
    //                 move_uploaded_file($filestmp, 'assets/img/' . uniqid() . '.' .  $extension);
    //                 $message = 'Votre fichier a été téléchargé avec succès.';
    //             } else {
    //                 $message = 'Votre fichier n\'a pas été téléchargé. Veuillez réessayer.';
    //             }
    //         } else {
    //             $message = 'Error: ' . $_FILES['file']['error'];
    //         }
    //     } else {
    //         $message = 'Votre format de fichier n\'est pas conforme. Fichier autorisé : JPG/JPEG/GIF/PNG';
    //     }
    // }
};

/* ---------- Vérifications Inputs Login Password ---------- */

/* Tableaux pour l'admin et l'user */
$adminArray = [
    'usernameAdmin' => 'superadmin',
    'passwordAdmin' => '$2y$10$06bQFmoWx6Q0chQvc0vmROHFMPfA4sKTt/fuiLknppWljdsoqg3nW'
];

$userArray = [
    'usernameUser' => 'superuser',
    'passwordUser' => '$2y$10$hpkUbDCzGH5SaGNngPDX5exRruL4qZzInawigf2RV.vY2xSyLyIA2'
];

/* Vérifications des inputs */
$error = [];
$success = [];

if (isset($_POST['username'])) {
    if ($_POST['username'] == $adminArray['usernameAdmin'] && $_POST['password'] == $adminArray['passwordAdmin']) {
        $_SESSION['username'] = 'superadmin';
        header('Location: dashboard.php');
    } else if ($_POST['username'] == $userArray['usernameUser'] && $_POST['password'] == $userArray['passwordUser']) {
        $_SESSION['username'] = 'superuser';
        header('Location: gallery.php');
    } else {
        $error['username'] = 'Le login n\'est pas conforme';
    }
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error['password'] = 'Veuillez remplir ce champs';
    };
};

if (isset($_POST['password'])) {
    $hashAdmin = '$2y$10$06bQFmoWx6Q0chQvc0vmROHFMPfA4sKTt/fuiLknppWljdsoqg3nW';

    if (password_verify($_POST['password'], $hashAdmin)) {
        $success['password'] = 'Le mot de passe est valide !';
    } else {
        $error['password'] = 'Le mot de passe est invalide.';
    }

    $hashUser = '$2y$10$hpkUbDCzGH5SaGNngPDX5exRruL4qZzInawigf2RV.vY2xSyLyIA2';

    if (password_verify($_POST['password'], $hashUser)) {
        $success['password'] = 'Le mot de passe est valide !';
    } else {
        $error['password'] = 'Le mot de passe est invalide.';
    }
}


/* ---------- Vérifications taille du dossier ---------- */

function TailleDossier($Rep)
{
    $Racine = opendir($Rep);
    $Taille = 0;
    while ($Dossier = readdir($Racine)) {
        if ($Dossier != '..' and $Dossier != '.') {
            //Ajoute la taille du sous dossier
            if (is_dir($Rep . '/' . $Dossier)) $Taille += TailleDossier($Rep . '/' .
                $Dossier);
            //Ajoute la taille du fichier
            else $Taille += filesize($Rep . '/' . $Dossier);
        }
    }
    closedir($Racine);
    return $Taille;
}
