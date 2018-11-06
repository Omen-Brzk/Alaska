<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 25/10/2018
 * Time: 15:29
 */
?>

<?php ob_start(); ?>
<body class="admin-panel-bg">
    <div class="container-fluid text-center author-content">
        <div class="author-box text-center">
            <h5 class="form-heading">Données utilisateur <?= $user->getUsername() ?> (inscrit le : <?= $user->getDateSignin() ?>)</h5>
            <hr>
            <form method="POST">
                <div class="form-group">
                    <p class="lead">Pseudo :</p>
                    <input class="form-control" type="text" name="username" value="<?= $user->getUsername()?>">
                </div>
                <div class="form-group">
                    <p class="lead">Adresse mail :</p>
                    <input class="form-control" type="email" name="mail" value="<?= $user->getMail()?>">
                </div>
                <hr>
                <button class="btn btn-outline-light btn-lg" type="submit" name="submit"><i class="fas fa-check"></i> Valider</button>
            </form>
        </div>
        <a class="btn btn-outline-light" href="index.php?action=showAccount"><i class="fa fa-home"></i> Retour au panel</a>
    </div>
</body>
<?php $content = ob_get_clean();
require('template/body.php'); ?>
