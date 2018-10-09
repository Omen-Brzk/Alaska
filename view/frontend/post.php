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

<?php
    foreach($comments as $comment)
    { ?>
        <h6 class=""><?= $comment->getAuthor();?>  le   <?= $comment->getCommentDate(); ?> </h6>
        <p class=""><?= $comment->getCommentText() ?></p>

<?php
    }


?>
</div>
<a href="index.php">Retour à l'accueil</a>
<?php  $content = ob_get_clean();

require('template/body.php');

?>


