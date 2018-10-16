<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 09/10/2018
 * Time: 14:31
 */

$title = $post->getTitle();

 ob_start(); ?>

<h1 class="badge-success"><?= $title ?></h1>
<p class="jumbotron"><?= $post->getContent() ?></p>
<p class="alert-dark">Article crée le : <?= $post->getCreationDate() ?> par Jean-Forteroche</p>

<?php if (isset($_SESSION['user'])) { ?>
<div class="jumbotron">
    <h5>Commentaires</h5>

    <b>Postez votre commentaire !</b>
    <form method="POST">
       <input type="text" name="commentText" placeholder="Votre commentaire...">
        <input type="submit" name="submit" value="Valider">
        <input type="hidden" name="postId" value="<?= $post->getId() ?>">
    </form>
    <?= isset($message) ? $message : "" ?>
<?php } else { ?>
    <h5>Commentaires</h5>
    <p class="alert-info">Vous devez être <a href="index.php?action=login">connecté</a> pour commenter cet article !</p>
<?php } ?>

    <?php include('comments.php'); ?>
</div>
<a href="index.php">Retour à l'accueil</a>
<?php  $content = ob_get_clean();

require('template/body.php');

?>


