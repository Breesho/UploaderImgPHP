<?php
session_start();

/* Vérifications pour l'upload d'image */
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
        if (!in_array($detected_type, $allowed)) {
            $message = 'Votre format de fichier n\'est pas conforme. Fichier autorisé : JPG/JPEG/GIF/PNG';
        } else {
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {

                $filename = $_FILES['file']['name'];
                $filetype = $_FILES['file']['type'];
                $filesize = $_FILES['file']['size'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 1024 * 1024;
                if ($filesize > $maxsize) {
                    $noUpload = true;
                    $message = 'La taille de l\'image est supérieure à 1 Mo (' . round($filesize  / 1000000) .  ' Mo) , veuillez réessayer';
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

/* Tableaux pour l'admin et l'user */

$adminArray = [
    'usernameAdmin' => 'superadmin',
    'passwordAdmin' => 'superadmin'
];

$userArray = [
    'usernameUser' => 'superuser',
    'passwordUser' => 'superuser'
];

/* Vérifications avec Regex des inputs */

$error = [];

if (isset($_POST['username'])) {
    echo 1;
    if ($_POST['username'] == $adminArray['usernameAdmin']) {
            $_SESSION['username'] = 'superadmin';
            header('Location: dashboard.php');
    } else if ($_POST['username'] == $userArray['usernameUser']) {
            $_SESSION['username'] = 'superuser';
            header('Location: gallery.php');
    } else {
        $error['username'] = 'Le login n\'est pas conforme';
    }
    if (empty($_POST['username'])) {
        $error['username'] = 'Veuillez remplir ce champs';
    };
};

if (isset($_POST['password'])) {
    if (!$adminArray['passwordAdmin']) {
        $error['password'] = 'Le Mot de Passe n\'est pas conforme';
    };
    if (empty($_POST['password'])) {
        $error['password'] = 'Veuillez remplir ce champs';
    };
};

if (isset($_POST['password'])) {
    if (!$userArray['passwordUser']) {
        $error['password'] = 'Le Mot de Passe n\'est pas conforme';
    };
    if (empty($_POST['password'])) {
        $error['password'] = 'Veuillez remplir ce champs';
    };
};

/* Vérifications taille du dossier */

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
