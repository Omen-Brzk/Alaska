<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 12/10/2018
 * Time: 13:36
 */
?>

<?php ob_start() ?>

<fieldset>
    <legend>Mes infos</legend>
    <div class="user-infos">

        <?php if($user->getGroupId() == User::IS_USER) { ?>
            <span class="badge badge-pill badge-primary">Utilisateur</span>
        <?php }

        elseif($user->getGroupId() == User::IS_ADMIN) { ?>
            <span class="badge badge-pill badge-warning">Administrateur</span>
        <?php }

        elseif($user->getGroupId() == User::IS_AUTHOR) { ?>
            <span class="badge badge-pill badge-danger">Auteur</span>
        <?php } ?>
    <label for="pseudo">Pseudo : </label> <span><?= $user->getUsername();?></span>
    <p></p>
    <label for="pseudo">Mail : </label> <span><?= $user->getMail(); ?></span>
    <p></p>
    <p>Membre inscrit le : <?= $user->getDateSignin(); ?></p>
    </div>
</fieldset>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>
