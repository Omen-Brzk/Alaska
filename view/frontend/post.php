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

<div class="jumbotron">
    <h5>Commentaires</h5>
    <form method="post">
        <textarea id="tinymce-editor">Ecrivez votre commentaire ici !</textarea>
        <input type="submit" name="submit" value="Publier">
    </form>
    <?php include('comments.php'); ?>
</div>
<a href="index.php">Retour à l'accueil</a>
<?php  $content = ob_get_clean();

require('template/body.php');

?>


