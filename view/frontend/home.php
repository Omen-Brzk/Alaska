<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 15:48
 */
?>

<?php ob_start(); ?>

<div class="container-fluid">
    <section id="">
        <?php $count = 0;  ?>
        <?php if(isset($posts) && count($posts) > 0) { ?>
            <?php foreach ($posts as $post) { ?>
                <?php $count++; ?>

                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4"><?= $post->getTitle(); ?></h1>
                        <p class="lead"><span class="badge badge-pill badge-danger"><i class="fa fa-user"></i> Auteur</span> Jean Forteroche</p>
                        <p class="lead"><i class="far fa-calendar"></i> <?= $post->getCreationDate(); ?></p>
                        <hr class="my-4">
                        <p class="lead"><?= $post->getPostRecap(); ?></p>
                        <a class="btn btn-primary btn-lg" role="button" href="index.php?action=showPost&id=<?= $post->getId(); ?>">Lien de l'article</a>
                    </div>
                </div>
                <?php
                if($count == $maxPosts) break;
            }
        }
        else {
            echo 'Aucun article';
        }
        ?>
    </section>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>