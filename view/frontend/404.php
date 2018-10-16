<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 16/10/2018
 * Time: 17:02
 */

ob_start(); ?>

<?= isset($error) ? $error : 'Une erreur inconnue est survenue' ?>

<a href="index.php">Retourner à l'accueil</a>




<?php  $content = ob_get_clean();

require('template/body.php');

?>