<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 16/10/2018
 * Time: 17:02
 */

ob_start(); ?>

<?php $title = 'Erreur 404' ?>
<body class="errorpage-bg" >

    <div class="jumbotron vertical-center">
        <div class="container text-center">
            <h1 class="text-center error-page-component">ERREUR 404</h1>
            <?= isset($error) ? '<p class="error-page-component">'. $error . '</p>' : '<p class="text-center error-page-component">Une erreur inconnue est survenue</p>' ?>

            <div class="text-center">
                <button class="btn btn-custom btn-outline-light btn-lg">
                    <i class="fas fa-home"></i> <a href="index.php">Retourner à l'accueil</a>
                </button>
            </div>
        </div>
    </div>

</body>
<?php  $content = ob_get_clean();

require('template/body.php');

?>