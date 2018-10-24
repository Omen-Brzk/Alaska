<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 23/10/2018
 * Time: 18:06
 */
?>

   <p class="lead text-center">
        Fonctionnalités Auteur
    </p>
    <table class="table table-dark table-striped table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Id de l'article</th>
            <th scope="col">Résumé</th>
            <th scope="col">Date de création</th>
            <th scope="col">Modération</th>
        </tr>
        </thead>
        <tbody>

        <?php if(!empty($postList))
        { ?>
            <tr>
                    <td class="text-center" colspan="6">
                        <button type="button" class="btn btn-outline-light btn-sm">
                            <a class="btn-admin" href="index.php?action=createPost">Créer un article</a>
                        </button>
                    </td>
                </tr>
            <?php foreach ($postList as $post) { ?>
                <tr>
                    <td><?= $post->getId() ?></td>
                    <td class=""><?= $post->getPostRecap() ?></td>
                    <td><?= $post->getCreationDate() ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-success btn-sm">
                            <a class="btn-admin" href="index.php?action=showPost&id=<?= $post->getId() ?>">Accéder à l'article</a>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-info btn-sm">
                            <a class="btn-admin" href="index.php?action=editPost&id=<?= $post->getId() ?>">Editer l'article</a>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-sm">
                            <a class="btn-admin" href="index.php?action=deletePost&id=<?= $post->getId() ?>">Supprimer l'article</a>
                        </button>
                    </td>
                </tr>
            <?php }
        }
        else { ?>
            <tr>
                <td class="text-center" colspan="6">
                    <button type="button" class="btn btn-outline-light btn-sm">
                        <a class="btn-admin" href="index.php?action=createPost">Créer un article</a>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="bg-danger text-center" colspan="6">Aucun article n'a été posté.</td>
            </tr>
        <?php }?>
        </tbody>
    </table>