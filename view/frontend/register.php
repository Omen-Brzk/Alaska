<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 22:55
 */
?>

<?php ob_start(); ?>


<form method="POST">
    Pseudo<input type="text" name="username" />
    Mdp<input type="password" name="userpass" />
    Mdp_confirm<input type="password" name="userpass-confirm" />
    Mail<input type="email" name="mail" />
    <input type="submit" name="submit" value="valider l'inscription"/>
</form>

<?php if(isset($errors)){
    foreach ($errors as $error) echo 'Erreur : ' . $error . '<br>';} ?>
<?= isset($empty) ? $empty : "" ?>
<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>
