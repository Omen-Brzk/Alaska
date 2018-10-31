<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 23/10/2018
 * Time: 18:50
 */

?>

<?php ob_start() ?>

<body class="admin-panel-bg">
<div class="container-fluid text-center author-content">

<div class="author-box text-center">
    <h1>Creation d'article</h1>
    <form method="post">
        <div class="form-group">
            <p class="lead">Titre de l'article</p>
            <input class="form-control" type="text" name="title" value="<?= isset($post) ? $post->getTitle() : '' ?>">
        </div>
        <div class="form-group">
            <p class="lead">Resumé de l'article</p>
            <input class="form-control" type="text" name="postRecap" value="<?= isset($post) ? $post->getPostRecap() : '' ?>">
        </div>
        <hr>
        <textarea class="form-control" id="tinymce-editor" name="content"><?= isset($post) ? $post->getContent() : '' ?></textarea>
        <hr>
        <button class="btn btn-outline-light btn-lg" type="submit" name="submit"><i class="fas fa-check"></i> Valider</button>
    </form>
    <hr>
    <?= isset($message) ? $message : '' ?>
</div>
    <button class="btn btn-outline-light"><i class="fa fa-home"></i><a href="index.php?action=showAccount"> Retour au panel</a>
</div>











<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');
