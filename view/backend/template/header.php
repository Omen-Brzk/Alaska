<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/10/2018
 * Time: 23:16
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= isset($title) ? $title : 'Page inconnue' ?></title>

    <!-- PERSONNAL CSS -->
    <link href="public/css/style.css" rel="stylesheet">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!-- BOOTSRAP -->
    <script src="public/inc/js/bootsrap/bootstrap.min.js"></script>
    <script src="public/inc/js/bootsrap/bootstrap.bundle.js"></script>
    <link href="public/inc/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

    <!-- TINY MCE -->
    <script src="public/inc/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: '#tinymce-editor',
            language : 'fr_FR'
        });
    </script>
    <script>$(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>

<?php
    if(isset($_SESSION['user']))
        echo '<a href="index.php?action=disconnect">déconnexion</a>';
        elseif(isset($_GET['action']))
        {
            if($_GET['action'] == 'register')
            {
                return NULL;
            }
            elseif($_GET['action'] =='login')
            {
                return NULL;
            }

        } else {
        echo '<a href="index.php?action=login">Se connecter</a> ou <a href="index.php?action=register">s\'inscrire</a>';
    }

?>