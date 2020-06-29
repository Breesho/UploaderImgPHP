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
                } else if (TailleDossier('assets/galerie/') + $filesize > $tailleDossier) {
                    $noUpload = true;
                    $message = 'La taille maximale du dossier a été atteinte';
                } else if (in_array($filetype, $allowed) && !$noUpload) {
                    move_uploaded_file($_FILES['file']['tmp_name'], 'assets/galerie/' . uniqid() . '.' . $ext);
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
    //                 move_uploaded_file($filestmp, 'assets/galerie/' . uniqid() . '.' .  $extension);
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
    'passwordAdmin' => '$2y$10$hItIPIRio/awMgYSZULLw.wJlppRQyN4aRXUGIkEjkt7li0bmVbkG'
];

$userArray = [
    'usernameUser' => 'superuser',
    'passwordUser' => '$2y$10$O0oStb6BmJh8H0EDJcMiq.Ctb0d01PqIO6xufPW8RM9aF3TV99GAe'
];

/* Vérifications des inputs */
$error = [];

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['username'] == $adminArray['usernameAdmin'] && password_verify($_POST['password'], $adminArray['passwordAdmin'])) {
        $_SESSION['username'] = 'superadmin';
        header('Location: dashboard.php');
    } else if ($_POST['username'] == $userArray['usernameUser'] && password_verify($_POST['password'], $userArray['passwordUser'])) {
        $_SESSION['username'] = 'superuser';
        header('Location: gallery.php');
    } else {
        $error['password'] = 'Le login ou le mot de passe n\'est pas bon';
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


/* ---------- Affichage images Photoswipe ---------- */

$dir = 'assets/galerie/';
$scanDir = array_diff(scandir($dir), array('..', '.'));


/* ---------- Kill Session ---------- */

if (isset($_POST['killSession'])) {
    session_destroy();
}