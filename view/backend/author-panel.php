<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 23/10/2018
 * Time: 18:06
 */
?>

   <p class="lead text-center author-content">
        Fonctionnalités Auteur
    </p>
    <table class="table table-dark table-striped table-hover table-sm">
        <thead>
        <tr class="sm-grid">
            <th scope="col">Id de l'article</th>
            <th scope="col">Résumé</th>
            <th scope="col">Date de création</th>
            <th scope="col">Modération</th>
        </tr>
        </thead>
        <tbody>

        <?php if(!empty($postList))
        { ?>
            <tr class="sm-grid">
                    <td class="text-center" colspan="6">
                        <a class="btn btn-outline-light" href="index.php?action=createPost">Créer un article</a>
                    </td>
                </tr>
            <?php foreach ($postList as $post) { ?>
                <tr class="sm-grid">
                    <td><?= $post->getId() ?></td>
                    <td><?= $post->getPostRecap() ?></td>
                    <td><?= $post->getCreationDate() ?></td>
                    <td>
                        <a class="btn btn-outline-success btn-sm" href="index.php?action=showPost&id=<?= $post->getId() ?>">Accéder à l'article</a>
                    </td>
                    <td>
                        <a class="btn btn-outline-info btn-sm" href="index.php?action=editPost&id=<?= $post->getId() ?>">Editer l'article</a>
                    </td>
                    <td>
                        <a class="btn btn-outline-danger btn-sm" href="index.php?action=deletePost&id=<?= $post->getId() ?>">Supprimer l'article</a>
                    </td>
                </tr>
            <?php }
        }
        else { ?>
            <tr class="sm-grid">
                <td class="text-center" colspan="6">
                    <a class="btn btn-outline-light btn-sm" href="index.php?action=createPost">Créer un article</a>
                </td>
            </tr>
            <tr class="sm-grid">
                <td class="bg-danger text-center" colspan="6">Aucun article n'a été posté.</td>
            </tr>
        <?php }?>
        </tbody>
    </table>