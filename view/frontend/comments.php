<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 16:38
 */
?>
    <?php if (!is_null($comments))
    { ?>
        <?php foreach($comments as $comment)
        { ?>
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()); ?>
            <h5><i class="fa fa-comment"></i> <?= isset($user) ? $user->getUsername() : '<em>Utilisateur supprimé</em>'?> <small><em>(<?= 'Posté le ' . convertDatetimeToString($comment->getCommentDate()) ?>)</em></small></h5>
                <?php if (!is_null($comment->getReports()) && $comment->getReports() > 0)
                {
                  echo '<p class=" alert alert-info">Ce commentaire est en cours de modération</p>';
                }
                else
                {
                    echo '<p id="comment-text">' . $comment->getCommentText() . '</p>';
                }
                ?>
                <?php if (isset($_SESSION['user']))
                {
                    if($_SESSION['user']->getId() == $comment->getAuthorId()) {
                        if (!is_null($comment->getReports()) && $comment->getReports() > 0)
                        { ?>
                            <button type="button" class="btn btn-custom btn-primary btn-sm disabled" data-placement="bottom" data-toggle="tooltip" title="Vous ne pouvez pas modifier un commentaire signalé"> Modifier</a></button>
                        <?php }
                        else { ?>
                            <a class="btn btn-custom btn-primary btn-sm" href="index.php?action=commentEdit&commentId=<?= $comment->getId() ?>">Modifier</a>
                            <?php } ?>
                   <?php }?>
                    <?php if($comment->getReports() > 0)
                    { ?>
                    <button type="button" class="btn btn-custom btn-outline-danger btn-sm disabled" data-placement="bottom" data-toggle="tooltip" title="Commentaire déja signalé">Signaler</a></button>
                    <?php }
                    elseif($_SESSION['user']->getId() != $comment->getAuthorId() && isset($_SESSION['user'])) { ?>
                        <a class="btn btn-custom btn-outline-danger btn-sm" href="index.php?action=reportComment&commentId=<?= $comment->getId() ?>">Signaler</a>
                    <?php } ?>
         <?php  } ?>
            <hr />
            <?php
        } ?>
    <?php
    }
    else { ?>
        <div class="container">
            <div class="alert alert-danger text-center">Il n'y a aucun commentaire pour le moment. Ecrivez en un !</div>
        </div>
    <?php } ?>