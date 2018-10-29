<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 15:48
 */
?>

<?php ob_start(); ?>

    <header class="masthead" style="background-image: url('public/img/original_ALASKA_banner.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Jean-Forteroche</h1>
                        <span class="subheading">Écrivain et voyageur chevronné</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php $count = 0;  ?>
    <?php if(isset($posts) && count($posts) > 0) { ?>
        <?php foreach ($posts as $post) { ?>
            <?php $count++; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">
                    <a href="index.php?action=showPost&id=<?= $post->getId()?>">
                        <h2 class="post-title">
                            <?= $post->getTitle() ?>
                        </h2>
                        <h3 class="post-subtitle">
                           <?= $post->getPostRecap() ?>
                        </h3>
                    </a>
                    <p class="post-meta"><?= $post->getCreationDate() ?> par <span class="badge badge-pill badge-danger"><i class="fa fa-user"></i> Auteur</span> Jean Forteroche</p></p>
                </div>
            </div>
        </div>
        <hr>
            <?php
            if($count == $maxPosts) break;
        }
    }
    else {
        echo 'Aucun article';
    }
    ?>



<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>