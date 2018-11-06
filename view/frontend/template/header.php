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

    <!-- PERSONNAL SOURCES -->
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/css/style.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <!-- BOOTSRAP -->
    <script src="public/inc/js/bootsrap/bootstrap.min.js"></script>
    <script src="public/inc/js/bootsrap/bootstrap.bundle.js"></script>
    <link href="public/inc/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- FONT AWESOME -->
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
if(!isset($_SESSION['user']))
{ ?>
    <nav class="navbar navbar-custom navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <a class="navbar-brand" href="#">Billet simple pour l' Alaska</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=login"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=register"><i class="fas fa-user-plus"></i> S'inscrire</a>
                </li>
            </ul>
        </div>
    </nav>
<?php } else
{?>
    <nav class="navbar navbar-custom navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.php">Billet simple pour l' Alaska</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user"></i> <?= $_SESSION['user']->getUsername() ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php if ($_SESSION['user']->getGroupId() == User::IS_AUTHOR || $_SESSION['user']->getGroupId() == User::IS_ADMIN)
                        { ?>
                            <a class="dropdown-item" href="index.php?action=showAccount"><i class="fas fa-users-cog"></i> Panel Admin</a>
                        <?php }
                        else
                        { ?>
                            <a class="dropdown-item" href="index.php?action=showAccount"><i class="fas fa-user-circle"></i> Mon compte</a>
                        <?php } ?>
                        <a class="dropdown-item" href="index.php?action=disconnect"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
<?php }?>

