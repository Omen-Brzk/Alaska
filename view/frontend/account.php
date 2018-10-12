<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 12/10/2018
 * Time: 13:36
 */
?>

<?php ob_start() ?>

<fieldset><legend>Mes infos</legend>
    <label for="pseudo">Pseudo : </label> <span><?= $user->getUsername();?></span>
    <p></p>
    <label for="pseudo">Mail : </label> <span><?= $user->getMail(); ?></span>
    <p></p>
    <p>Membre inscrit le : <?= $user->getDateSignin(); ?></p>
</fieldset>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>
