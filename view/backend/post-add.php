<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 23/10/2018
 * Time: 18:50
 */

?>

<?php ob_start() ?>


<div class="container">

<div>
    <h1>Creation d'article</h1>
</div>

    <form method="post">
        <label for="postRecap">Titre de l'article</label> <input type="text" name="title">
        <label for="postRecap">Resumé de l'article</label> <input type="text" name="postRecap">
        <hr>
        <textarea id="tinymce-editor" name="content"></textarea>
        <input type="submit" value="Valider">
    </form>

</div>










<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');
