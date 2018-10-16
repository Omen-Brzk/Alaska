<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 16/10/2018
 * Time: 16:19
 */

ob_start(); ?>

<?php if (isset($_SESSION['user'])) { ?>
    <div class="jumbotron">
    <h5>Votre commentaire</h5>

    <b>Modifier votre commentaire !</b>
    <form method="POST">
        <textarea type="text" name="commentText"><?= $comment->getCommentText() ?></textarea>
        <input type="submit" name="submit" value="Valider">
        <input type="hidden" name="commentId" value="<?= $comment->getId() ?>">
    </form>
    <?= isset($message) ? $message : "" ?>
<?php } else { ?>
    <h5>Commentaires</h5>
    <p class="alert-info">Vous n'êtes pas autorisé à modifier ce commentaire</p>
<?php } ?>
    </div>
    <a href="index.php">Retour à l'accueil</a>
<?php  $content = ob_get_clean();

require('template/body.php');

?>