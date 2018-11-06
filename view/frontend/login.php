<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 12/10/2018
 * Time: 17:32
 */

?>

<?php ob_start();?>

<?php if(!isset($_SESSION['user'])) { ?>
<body class="login-page">
    <div class="login-form vertical-center">
        <div class="main-div">
            <div class="panel">
                <h1>Connexion</h1>
                <p>Veuillez rentrer votre pseudo et mot de passe</p>
            </div>
            <form id="Login" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Pseudo" value="<?= isset($_COOKIE['user_get_name']) ? $datas['username'] : '' ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="userpass" class="form-control" id="inputPassword" placeholder="Mot de passe">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
                <?= isset($message) ? $message : "" ?>
                <div class="forgot">
                    <a href="index.php?action=register">Pas de compte? Inscrivez vous !</a>
                </div>
                <hr>
                <a class="btn btn-custom btn-primary" href="index.php"><i class="fa fa-home"></i> Retourner à l'accueil</a>
            </form>
        </div>
    </div>
</body>
<?php } ?>



<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>
