<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 16/10/2018
 * Time: 16:19
 */

ob_start(); ?>

<?php if (isset($_SESSION['user'])) { ?>
    <body class="admin-panel-bg">
        <div class="container-fluid text-center padding-box">
            <div class="author-box">
                <h5>Votre commentaire</h5>
                <div class="form-group">
                    <p class="lead">Modifier votre commentaire !</p>
                    <form method="POST">
                        <textarea class="form-control" type="text" name="commentText"><?= $comment->getCommentText() ?></textarea>
                        <hr>
                        <button class="btn btn-outline-light btn-lg" type="submit" name="submit"><i class="fas fa-check"></i> Valider</button>
                        <input type="hidden" name="commentId" value="<?= $comment->getId() ?>">
                    </form>
                <hr>
                <?= isset($message) ? $message : "" ?>
            </div>
        </div>
        <?php }
        else { ?>
            <h5>Commentaires</h5>
            <p class="alert-info">Vous n'êtes pas autorisé à modifier ce commentaire</p>
        <?php } ?>
            <a class="btn btn-outline-light" href="index.php"><i class="fa fa-home"></i> Retour à l'accueil</a>
        </div>
    </body>
<?php  $content = ob_get_clean();
require('template/body.php'); ?>