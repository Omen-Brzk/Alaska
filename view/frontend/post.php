<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 09/10/2018
 * Time: 14:31
 */

$title = $post->getTitle();

 ob_start(); ?>

<header class="masthead" style="background-image: url('public/img/Alaska_2.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1><?= $post->getTitle() ?></h1>
                    <span class="subheading"><?= $post->getPostRecap()?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p><?= $post->GetContent()?></p>
            <div class="post-preview">
                <p class="post-meta"><?= $post->getCreationDate() ?> par <span class="badge badge-pill badge-danger"><i class="fa fa-user"></i> Auteur</span> Jean Forteroche</p>
            </div>
        </div>
        </div>
</div>

<hr>

<?php if (isset($_SESSION['user'])) { ?>
<div class="container">
    <div class="row">
        <div class="col">
            <form method="POST">
                <div class="form-group">
                    <h5>Commentaires</h5>
                    <?= isset($message) ? $message : "" ?>
                    <label for="exampleFormControlTextarea1" id="CommentZone">Votre commentaire</label>
                    <textarea class="form-control" name="commentText" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <input type="hidden" name="postId" value="<?= $post->getId() ?>">
                    <button type="submit" name="submit" class="btn btn-custom btn-primary float-right"><i class="fa fa-reply"></i> Envoyer</button>
                </div>
            <?php } else { ?>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5>Commentaires</h5>
                            <p class="alert alert-info alert">Vous devez être <a href="index.php?action=login"><b>connecté</b></a> pour commenter cet article !</p>
            <?php } ?>
        <?php include('comments.php'); ?>
    </div>
    </div>
    <div class="text-center">
        <button class="btn btn-outline-dark text-center"><i class="fa fa-home"></i><a href="index.php"> Retour à l'accueil</a>
    </div>
</div>
<?php  $content = ob_get_clean();

require('template/body.php');

?>


