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
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()); ?>
                <section id="single-comment">
                    <h6 id="comment-author"><?= $user->getUsername() ?></h6>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $comment->getAuthorId()) { ?>
                        <a href="index.php?action=commentEdit&commentId=<?= $comment->getId() ?>">(Modifier)</a>
                    <?php } ?>
                    <?php if($comment->getReports() > 0) { ?>
                        <p class="alert-info">Ce commentaire est en cours de modération</p>
                    <?php } else { ?>
                        <a href="index.php?action=reportComment&commentId=<?= $comment->getId() ?>">(Signaler)</a>
                    <?php } ?>

                    <span id="comment-date"><?=  $comment->getCommentDate() ?></span>
                    <p id="comment-text"><?= $comment->getCommentText(); ?></p>
                </section>
        <?php } ?>
    <?php } else { ?>

        <span class="alert-danger">Il n'y a aucun commentaire pour le moment. Ecrivez en un ! <a href="index.php?action=login">(vous devez être connecté)</a></span>

    <?php } ?>
</section>