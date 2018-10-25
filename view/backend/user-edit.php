<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 25/10/2018
 * Time: 15:29
 */
?>

<?php ob_start(); ?>

<div class="jumbotron">
    <h5>Données utilisateur <?= $user->getUsername() ?> (inscrit le : <?= $user->getDateSignin() ?>)</h5>

    <form method="POST">
       <label for="username">Pseudo :</label> <input type="text" name="username" value="<?= $user->getUsername()?>">
        <label for="mail">adresse mail :</label> <input type="email" name="mail" value="<?= $user->getMail()?>">
        <input type="submit" name="submit" value="valider">
    </form>
</div>
<a href="index.php?action=showAccount">Retour au panel</a>
<?php  $content = ob_get_clean();

require('template/body.php');

?>
