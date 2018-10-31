<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 24/10/2018
 * Time: 14:10
 */
?>

<?php ob_start() ?>

    <body class="admin-panel-bg">
    <div class="container-fluid text-center">
        <div class="author-box text-center author-content">
            <h1>Edition de l'article</h1>
        <form method="post">
            <div class="form-group">
                <p class="lead">Titre de l'article</p>
                <input type="text" name="title" class="form-control" value="<?= $post->getTitle(); ?>">
            </div>
            <div class="form-group">
                <p class="lead">Resumé de l'article</p>
                <input type="text" name="postRecap" class="form-control" value="<?= $post->getPostRecap(); ?>">
            </div>

            <hr>
            <textarea id="tinymce-editor" name="content"><?= $post->getContent();?></textarea>
            <hr>
            <button class="btn btn-outline-light btn-lg" type="submit" name="submit"><i class="fas fa-check"></i> Valider</button>
        </form>
        </div>
        <button class="btn btn-outline-light"><i class="fa fa-home"></i><a href="index.php?action=showAccount"> Retour au panel</a>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');