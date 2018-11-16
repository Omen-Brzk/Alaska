<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 23/10/2018
 * Time: 18:06
 */
?>
<div class="container-fluid">
    <table class="table table-dark table-striped table-hover table-sm">
        <thead>
        <tr class="sm-grid">
            <th class="text-center h3" colspan="12">
                Fonctionnalités Auteur
                <hr>
            </th>
        </tr>
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
                    <a class="btn btn-outline-light" href="index.php?action=createPost"><i class="fas fa-pen"></i> Créer un article</a>
                </td>
            </tr>
            <?php foreach ($postList as $post) { ?>
            <tr class="sm-grid">
                <td><?= $post->getId() ?></td>
                <td><?= $post->getPostRecap() ?></td>
                <td><?= convertDatetimeToString($post->getCreationDate()) ?></td>
                <td>
                    <a class="btn btn-outline-success" data-placement="bottom" data-toggle="tooltip" title="Lire l'article" href="index.php?action=showPost&id=<?= $post->getId() ?>"> <i class="fas fa-glasses"></i></a>
                    <a class="btn btn-outline-info" data-placement="bottom" data-toggle="tooltip" title="Editer l'article" href="index.php?action=editPost&id=<?= $post->getId() ?>"> <i class="fas fa-edit"></i> </a>
                    <a class="btn btn-outline-danger" data-placement="bottom" data-toggle="tooltip" title="Supprimer l'article" href="index.php?action=deletePost&id=<?= $post->getId() ?>"> <i class="fas fa-trash-alt"></i> </a>
                </td>
            </tr>
        <?php }
        }
        else { ?>
            <tr class="sm-grid">
                <td class="text-center" colspan="6">
                    <a class="btn btn-outline-light" href="index.php?action=createPost">Créer un article</a>
                </td>
            </tr>
            <tr class="sm-grid">
                <td class="bg-danger text-center" colspan="6">Aucun article n'a été posté.</td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
