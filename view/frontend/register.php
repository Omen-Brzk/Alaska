<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 22:55
 */
?>

<?php ob_start(); ?>

<?php if(!isset($_SESSION['user'])) { ?>
    <body class="login-page" style='background-image:url("public/img/bg.png");background: rgb(2,0,36); background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);'>
    <div class="login-form vertical-center">
        <div class="main-div">
            <div class="panel">
                <h1>Inscription</h1>
                <p>Veuillez rentrer les informations de votre compte</p>
            </div>
            <form id="Login" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="<?= isset($_COOKIE['user_get_name']) ? $datas['username'] : 'Pseudo' ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="userpass" class="form-control" id="inputPassword" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input type="password" name="userpass-confirm" class="form-control" placeholder="Confirmer votre mot de passe">
                </div>
                <div class="form-group">
                    <input type="email" name="mail" class="form-control" placeholder="Adresse email">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
                <?= isset($message) ? $message : "" ?>
                <div class="forgot">
                    <a href="index.php?action=login">Déja un compte ? Connectez vous !</a>
                </div>
                <?php if(isset($errors)){
                    foreach ($errors as $error) echo  $error . '<br>';} ?>
                <?= isset($empty) ? $empty : "" ?>
                <hr>
                <button  class="btn btn-custom btn-primary"><a href="index.php"><i class="fa fa-home"></i> Retourner à l'accueil</a></button>
            </form>
        </div>
    </div>
    </body>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template/body.php'); ?>

<!-- <form method="POST">
    Pseudo<input type="text" name="username" />
    Mdp<input type="password" name="userpass" />
    Mdp_confirm<input type="password" name="userpass-confirm" />
    Mail<input type="email" name="mail" />
    <input type="submit" name="submit" value="valider l'inscription"/>
</form>