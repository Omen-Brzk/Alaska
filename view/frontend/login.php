<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 12/10/2018
 * Time: 17:32
 */

?>

<?php ob_start(); ?>

<?php if(!isset($_SESSION['user'])) { ?>
<h1>Connexion à l'espace membre</h1>
<form method="POST">
    <input type="text" name="username" value="<?= isset($_COOKIE['user_get_name']) ? $datas['username'] : '' ?>" >
    <input type="password" name="userpass">
    <input type="submit" name="submit" value="Se connecter">
</form>
    <?= isset($message) ? $message : "" ?>
<?php } ?>



<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');
