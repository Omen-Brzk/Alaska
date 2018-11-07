<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 15/10/2018
 * Time: 16:37
 */
?>

<?php ob_start() ?>

<?= isset($message) ? $message : '' ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR)
{
    require('view/backend/author-panel.php');
} ?>

<?php if (isset($_SESSION['user']) && $_SESSION['user']->getGroupId() > 1)
{ ?>
    <body class="admin-panel-bg">
        <div class="container-fluid main-content">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover table-sm">
                        <thead>
                        <tr class="sm-grid">
                            <th class="text-center h3" colspan="12">
                                Liste des utilisateurs enregistrés sur le site
                                <hr>
                            </th>
                        </tr>
                        <tr class="sm-grid">
                            <th scope="col">Id</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Date d'inscription</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Modération</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userList as $user)
                            { ?>
                                <tr class="sm-grid">
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
                                    <td>
                                        <a class="btn btn-outline-info btn-sm" href="index.php?action=editUser&id=<?= $user->getId()?>">Editer l'utilisateur</a>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Changer le rôle
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="index.php?action=promoteUser&id=<?=$user->getId()?>&groupid=<?= User::IS_ADMIN?>">Administrateur</a>
                                                <a class="dropdown-item" href="index.php?action=promoteUser&id=<?=$user->getId()?>&groupid=<?= User::IS_AUTHOR?>">Redacteur</a>
                                                <a class="dropdown-item" href="index.php?action=promoteUser&id=<?=$user->getId()?>&groupid=<?= User::IS_USER?>">Utilisateur</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger btn-sm" href="index.php?action=deleteUser&id=<?= $user->getId()?>">Supprimer l'utilisateur</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
            <table class="table table-dark table-striped table-hover table-sm">
            <thead>
            <tr class="sm-grid">
                <th class="text-center h3" colspan="12">
                    Liste des commentaires
                    <hr>
                </th>
            </tr>
            <tr class="sm-grid">
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
                        <tr class="sm-grid">
                            <td><?= $comment->getId() ?></td>
                            <td><?= isset($user) && !is_null($user->getUsername()) ? $user->getUsername() : '<em>Utilisateur supprimé</em>' ?></td>
                            <td><?= $comment->getCommentText() ?></td>
                            <td><?= $comment->getCommentDate() ?></td>
                            <?php if($comment->getReports() > 0) { ?>
                                    <td><i class="far fa-circle text-red" data-placement="bottom" data-toggle="tooltip" title="Commentaire signalé"></i></td>
                            <?php } else { ?>
                                    <td><i class="far fa-circle text-aqua" data-placement="bottom" data-toggle="tooltip" title="Aucun signalement"></i></td>
                            <?php } ?>
                            <td>
                                <a class="btn btn-outline-info btn-sm" href="index.php?action=editUserComment&id=<?= $comment->getId()?>">Editer le commentaire</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger btn-sm" href="index.php?action=deleteUserComment&id=<?= $comment->getId()?>">Supprimer le commentaire</a>
                            </td>
                            <?php if($comment->getReports() > 0) { ?>
                                <td>
                                    <a class="btn btn-outline-warning btn-sm" href="index.php?action=unReportComment&commentId=<?= $comment->getId() ?>">Retirer le signalement</a>
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
                </table>
            </div>
        </div>
    </body>
 <?php }

?>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php');
