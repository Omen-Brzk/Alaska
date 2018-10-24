<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 24/10/2018
 * Time: 14:10
 */
?>

<?php ob_start() ?>


    <div class="container">

        <div>
            <h1>Edition de l'article</h1>
        </div>

        <form method="post">
            <label for="title">Titre de l'article</label><input type="text" name="title" value="<?= $post->getTitle(); ?>">
            <label for="postRecap">Resumé de l'article</label> <input type="text" name="postRecap" value="<?= $post->getPostRecap(); ?>">
            <hr>
            <textarea id="tinymce-editor" name="content"><?= $post->getContent();?></textarea>
            <input type="submit" name="submit" value="Valider">
        </form>

    </div>










<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');