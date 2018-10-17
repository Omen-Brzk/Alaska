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
                    <span id="comment-date"><?=  $comment->getCommentDate() ?></span>
                    <p id="comment-text"><?= $comment->getCommentText(); ?></p>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $comment->getAuthorId()) { ?>
                        <button type="button" class="btn btn-primary btn-sm"> <a href="index.php?action=commentEdit&commentId=<?= $comment->getId() ?>">Modifier</a></button>
                    <?php } ?>
                    <?php if($comment->getReports() > 0) { ?>
                        <p class="alert-info">Ce commentaire est en cours de modération</p>
                        <button type="button" class="btn btn-outline-danger btn-sm disabled" data-placement="bottom" data-toggle="tooltip" title="Commentaire déja signalé"<a href="">Signaler</a></button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-danger btn-sm"><a href="index.php?action=reportComment&commentId=<?= $comment->getId() ?>">Signaler</a></button>
                    <?php } ?>
                </section>
            <hr />
        <?php } ?>
    <?php } else { ?>

        <span class="alert-danger">Il n'y a aucun commentaire pour le moment. Ecrivez en un ! <a href="index.php?action=login">(vous devez être connecté)</a></span>

    <?php } ?>
</section>