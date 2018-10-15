<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 16:38
 */

?>

<section id="comments-list">
    <?php if (!is_null($comments)) { ?>
        <?php foreach($comments as $comment) { ?>
                <section id="single-comment">
                    <h6 id="comment-author">Auteur inconnu</h6>
                    <span id="comment-date"><?= $comment->getCommentDate(); ?></span>
                    <p id="comment-text"><?= $comment->getCommentText(); ?></p>
                </section>
        <?php } ?>
    <?php } else { ?>

        <span class="alert-danger">Il n'y a aucun commentaire pour le moment. Ecrivez en un !</span>

    <?php } ?>
</section>