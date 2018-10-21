<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 15/10/2018
 * Time: 16:37
 */

?>

<?php ob_start() ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']->getGroupId() > 1)
{ ?>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR)
    { ?>
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
        {
            foreach ($postList as $post) { ?>
                <tr>
                    <td class="text-center" colspan="6">
                        <button type="button" class="btn btn-outline-light btn-sm">
                            <a class="btn-admin" href="index.php?action=createPost">Créer un article</a>
                        </button>
                    </td>
                </tr>
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
    <?php } ?>


    <p class="lead text-center">
        Liste des utilisateurs enregistrés sur le site
    </p>
    <table class="table table-dark table-striped table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Mail</th>
            <th scope="col">Date d'inscription</th>
            <th scope="col">Rôle</th>
            <th scope="col">Modération</th>
        </tr>
        </thead>
        <tbody>
    <?php foreach ($userList as $user) { ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getUsername() ?></td>
            <td><?= $user->getMail() ?></td>
            <td><?= $user->getDateSignin() ?></td>
            <td><?php  if($user->getGroupId() == User::IS_USER) { ?>
                <span class="badge badge-pill badge-primary">Utilisateur</span>
                <?php }
                elseif($user->getGroupId() == User::IS_ADMIN) { ?>
                <span class="badge badge-pill badge-warning">Administrateur</span>
                <?php }
                elseif($user->getGroupId() == User::IS_AUTHOR) { ?>
                <span class="badge badge-pill badge-danger">Auteur</span>
                <?php }   ?></td>
            <td><button type="button" class="btn btn-outline-light btn-sm"><a href="">Editer l'utilisateur</a></button></td>
        </tr>
    <?php } ?>
        </tbody>
    </table>

    <p class="lead text-center">
        Liste des commentaires signalés
    </p>
    <table class="table table-dark table-striped table-hover table-sm">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Auteur</th>
        <th scope="col">Contenu</th>
        <th scope="col">Date de création</th>
        <th scope="col">Signalements</th>
        <th scope="col">Modération</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($commentList))
    {
        foreach ($commentList as $comment) { ?>
            <?php $user = $userManager->getUserByNameOrId($comment->getAuthorId()) ?>
            <tr>
                <td><?= $comment->getId() ?></td>
                <td><?= $user->getUsername() ?></td>
                <td><?= $comment->getCommentText() ?></td>
                <td><?= $comment->getCommentDate() ?></td>
                <?php if($comment->getReports() > 0) { ?>
                        <td class="badge badge-pill badge-danger"> <?= $comment->getReports() ?></td>
                <?php } else { ?>
                        <td><?= $comment->getReports() ?></td>
                <?php } ?>
                <td><a href="">Editer le commentaire</a></td>
                <td><a href="">Supprimer le commentaire</a></td>
                <?php if($comment->getReports() > 0) { ?>
                    <td>
                        <button type="button" class="btn btn-outline-danger btn-sm">
                        <a class="btn-admin" href="index.php?action=unReportComment&commentId=<?= $comment->getId() ?>">Retirer le signalement</a>
                        </button>
                    </td>
                <?php } ?>
            </tr>
        <?php }
    }
    else { ?>
        <tr>
            <td class="bg-danger text-center" colspan="6">Aucun commentaire n'a été signalé.</td>
        </tr>
    <?php }?>
    </tbody>
    </table>
 <?php }

?>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');
