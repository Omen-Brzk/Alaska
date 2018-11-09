<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 10/10/2018
 * Time: 16:23
 */

require_once('model/CommentManager.php');
require_once('model/PostManager.php');
require_once('model/UserManager.php');

function showRegister()
{
    $title = 'Inscription';

    if(isset($_SESSION['user']))
    {
        return showUserAlreadyLogged();
    }

    return require('view/frontend/register.php');
}

function sendUserRegister($datas)
{
    $title = 'Inscription';
    $errors = [];

    if(isset($_SESSION['user']))
        return showUserAlreadyLogged();

    if($datas['username'] != '' && $datas['userpass'] != '' && $datas['userpass-confirm'] != '' && $datas['mail'] != '')
    {
        $userManager = new UserManager();

        if(!preg_match('/^([a-zA-Z-0-9-_ ]+)$/' , $datas['username']))
        {
            array_push($errors, '<div class=\'alert alert-custom alert-danger\'>Format du pseudo invalide (Lettres & chiffres uniquement)</div>');
        }

        if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/' , $datas['mail']))
        {
            array_push($errors, '<div class=\'alert alert-custom alert-danger\'>Veuillez entrer une adresse mail valide</div>');
        }

        if($userManager->usernameExist($datas['username']))
        {
            array_push($errors, '<div class=\'alert alert-custom alert-danger\'>Ce pseudo est déja utilisé</div>');
        }

        if($userManager->mailExist($datas['mail']))
        {
            array_push($errors, '<div class=\'alert alert-custom alert-danger\'>Cette adresse mail est déja utilisée</div>');
        }

        if($datas['userpass'] != $datas['userpass-confirm'])
        {
            array_push($errors,'<div class=\'alert alert-custom alert-danger\'>Les mots de passe ne correspondent pas</div>');
        }


        if(strlen($datas['userpass'] ) < 5 || strlen($datas['userpass-confirm']) < 5)
        {
            array_push($errors, '<div class=\'alert alert-custom alert-danger\'>Votre mot de passe doit faire au moins 5 caractères</div>');
        }

        if(count($errors) > 0)
        {
           return include('view/frontend/register.php');
        }

        $userInfos = array(
            'username' => $datas['username'],
            'userpass' => password_hash($datas['userpass'], PASSWORD_DEFAULT),
            'mail' => $datas['mail']
        );

        $user = new User($userInfos);
        $userManager->createUser($user);

        $user = $userManager->getUserByNameOrId($user->getUsername());

        $title = "Mon compte";
        $_SESSION['user'] = $user;
        header('Location: index.php?action=showAccount');
    }

    else
    {
        $empty = true;
        if($empty)
        {
            $empty = '<div class="alert alert-danger">Vous devez remplir tous les champs</div>';
            return include('view/frontend/register.php');
        }
    }
}

function showUserAlreadyLogged()
{
    header('Location: index.php');
}

function userDisconnect()
{
    if(!isset($_SESSION['user']))
    {
       header('Location: index.php');
    }

    session_destroy();
    header('Location: index.php');
}

function showUserAccount()
{
    if(!isset($_SESSION['user']))
    {
        showError404('Vous devez être connecté pour accéder à votre compte');
    }
    else
    {
        $userManager = new UserManager();
        $user = $userManager->getUserByNameOrId($_SESSION['user']->getId());

        if(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_USER )
        {
            $title = 'Mon compte';
            require('view/frontend/account.php');
        }

        elseif(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR OR User::IS_ADMIN )
        {
            admin_showPanel();
        }
    }
}

function sendUserLogin($datas)
{
    $title = 'Connexion';
    if(isset($_SESSION['user']))
        return showUserAlreadyLogged();

    if($datas['username'] != '' && $datas['userpass'] !='')
    {
        $_COOKIE['user_get_name'] = setcookie('user_get_name', '', time()+3600, null,null,false,true);
       $userManager = new UserManager();
       $user = $userManager->getUserByNameOrId($datas['username']);

       if(!is_null($user))
       {
           $password_verify = password_verify((string)$datas['userpass'], $user->getUserpass());

           if($password_verify)
           {
               if (isset($_COOKIE['user_get_name']))
               {
                   setcookie('user_get_name', '', time()-3600);
               }

               $_SESSION['user'] = $user;
               header('Location: index.php?action=showAccount');
           }
           else
           {
               $message = "<div class='alert alert-danger'>Mauvais pseudo ou mot de passe.</div>";
               return require('view/frontend/login.php');
           }
       }
       else
       {
           $message = "<div class='alert alert-custom alert-danger'>Mauvais pseudo ou mot de passe.</div>";
           return require('view/frontend/login.php');
       }
    }

    else
    {
        $message = "<div class='alert alert-custom alert-danger'>Vous devez remplir tous les champs pour vous connecter</div>";
        return require('view/frontend/login.php');
    }
}

function showUserLogin()
{
    if(isset($_SESSION['user']))
        return showUserAlreadyLogged();

    $title = "Connexion";
    require('view/frontend/login.php');
}

function showError404($errorText)
{
    $error = $errorText;
    require('view/frontend/404.php');
}