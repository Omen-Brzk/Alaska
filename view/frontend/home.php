<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 15:48
 */
?>

<?php ob_start(); ?>

    <section id="">
        <?php $count = 0;  ?>
        <?php if(isset($posts) && count($posts) > 0) { ?>
            <?php foreach ($posts as $post) { ?>
                <?php $count++; ?>

                <article  id="<?= $post->getId(); ?>">
                        <h1 id=""><?= $post->getTitle(); ?></h1>
                    <p><?= $post->getPostRecap(); ?></p>
                    <p><?= $post->getCreationDate(); ?></p>
                    <p><?= $post->getId();?></p>
                    <p><a href="index.php?action=showPost&id=<?= $post->getId(); ?>">Lien de l'article</a></p>
                </article>
                <?php
                if($count == $maxPosts) break;
            }
        }
        else {
            echo 'Aucun article';
        }
        ?>
    </section>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>