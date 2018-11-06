<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 12/10/2018
 * Time: 13:36
 */
?>

<?php ob_start(); ?>
<body class="account-page">
    <div class="vertical-center align-items-center user-panel">
        <div class="card text-center" style="width: 18rem;">
            <img class="card-img-top" src="public/img/user-placeholder.png" title="user-placeholder" alt="User avatar">
            <div class="card-body">
                <h5 class="card-title"><?= $user->getUsername()?></h5>
                <p class="card-text"><?= $user->getMail()?></p>
                <?php if($user->getGroupId() == User::IS_USER) { ?>
                    <span class="badge badge-pill badge-primary">Utilisateur</span>
                <?php }
                elseif($user->getGroupId() == User::IS_ADMIN) { ?>
                    <span class="badge badge-pill badge-warning">Administrateur</span>
                <?php }
                elseif($user->getGroupId() == User::IS_AUTHOR) { ?>
                    <span class="badge badge-pill badge-danger">Auteur</span>
                <?php } ?>
                <p><small><?= $user->getDateSignIn() ?></small></p>
                <hr>
                <a href="index.php" class="btn btn-primary"><i class="fa fa-home"></i> Accueil</a>
            </div>
        </div>
    </div>
</body>
<?php $content = ob_get_clean();
require('template/body.php'); ?>