<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 15:48
 */
?>

<?php ob_start(); ?>

    <header class="masthead masthead-home">
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

    <?php if(isset($posts) && !empty($posts))
    { ?>
        <?php foreach ($posts as $post)
        { ?>
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
                        <p class="post-meta"><?= 'Publié le ' . convertDatetimeToString($post->getCreationDate()) ?> par <span class="badge badge-pill badge-danger"><i class="fa fa-user"></i> Auteur</span> Jean Forteroche</p></p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php
        } ?>
        <!-- PAGINATION -->
            <nav aria-label="pagination navigation">
                <ul class="pagination justify-content-center">
                    <?php
                    for($i = 0; $i < $pages; $i++)
                    {
                        $number = $i;
                        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . ++$number . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
    <?php }
    else
    { ?>
        <div class="container">
            <div class="row">
                <div class="text-center alert alert-danger col-lg-8 col-md-10 mx-auto">Aucun article n'a été posté !
                <p class="lead">N'hésitez pas à revenir plus tard !</p>
                    <p class="small float-right">Jean Forteroche</p>
                </div>
            </div>
        </div>

    <?php
    }
?>

<?php $content = ob_get_clean();
require('template/body.php'); ?>