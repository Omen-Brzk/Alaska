<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 16:38
 */

?>
    <?php if (!is_null($comments)) { ?>
        <?php foreach($comments as $comment) { ?>
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()); ?>
                <h5><i class="fa fa-comment"></i> <?= $user->getUsername()?> <small><em>(<?=  $comment->getCommentDate() ?>)</em></small></h5>
                    <p id="comment-text">
                        <?php if (!is_null($comment->getReports()) && $comment->getReports() > 0)
                        {
                          echo '<p class=" alert alert-info">Ce commentaire est en cours de modération</p>';
                        }
                        else
                        {
                            echo $comment->getCommentText() . '</p>';
                        }
                        ?>
                    <?php if (isset($_SESSION['user']))
                    {
                        if($_SESSION['user']->getId() == $comment->getAuthorId()) {
                            if (!is_null($comment->getReports()) && $comment->getReports() > 0)
                            {?>
                                <button type="button" class="btn btn-custom btn-primary btn-sm disabled" data-placement="bottom" data-toggle="tooltip" title="Vous ne pouvez pas modifier un commentaire signalé"> Modifier</a></button>
                            <?php }
                            else { ?>
                                <button type="button" class="btn btn-custom btn-primary btn-sm"> <a href="index.php?action=commentEdit&commentId=<?= $comment->getId() ?>">Modifier</a></button>
                                <?php } ?>
                       <?php }?>
                        <?php if($comment->getReports() > 0) { ?>
                        <button type="button" class="btn btn-custom btn-outline-danger btn-sm disabled" data-placement="bottom" data-toggle="tooltip" title="Commentaire déja signalé">Signaler</a></button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-custom btn-outline-danger btn-sm"><a href="index.php?action=reportComment&commentId=<?= $comment->getId() ?>">Signaler</a></button>
                        <?php } ?>
                <?php } ?>
            <hr />
        <?php } ?>
    <?php } else { ?>
        <span class="alert alert-danger">Il n'y a aucun commentaire pour le moment. Ecrivez en un ! <a href="index.php?action=login">(vous devez être connecté)</a></span>
    <?php } ?>