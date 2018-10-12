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
            array_push($errors, 'Format du pseudo invalide (Lettres & chiffres uniquement)');
        }

        if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/' , $datas['mail']))
        {
            array_push($errors, 'Veuillez entrer une adresse mail valide');
        }

        if($userManager->usernameExist($datas['username']))
        {
            array_push($errors, 'Ce pseudo est déja utilisé');
        }

        if($userManager->mailExist($datas['mail']))
        {
            array_push($errors, 'Cette adresse mail est déja utilisée');
        }

        if($datas['userpass'] != $datas['userpass-confirm'])
        {
            array_push($errors,'Les mots de passe ne correspondent pas');
        }


        if(strlen($datas['userpass'] ) < 5 || strlen($datas['userpass-confirm']) < 5)
        {
            array_push($errors, 'Votre mot de passe doit faire au moins 5 caractères');
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
            $empty = 'Vous devez remplir tous les champs';
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

function showUserAccount($user)
{
    $userManager = new UserManager();

    if(!isset($_SESSION['user']))
    {
        header('Location: index.php');
    }

    $title = 'Mon compte';
    require('view/frontend/account.php');
}

function sendUserLogin($datas)
{


    if(isset($_SESSION['user']))
        return showUserAlreadyLogged();

    if($datas['username'] != '' && $datas['userpass'] !='')
    {
       $userManager = new UserManager();
       $user = $userManager->getUserByNameOrId($datas['username']);

       if(!is_null($user))
       {
           $password_verify = password_verify((string)$datas['userpass'], $user->getUserpass());

           if($password_verify)
           {
               $_SESSION['user'] = $user;
               header('Location: index.php?action=showAccount');
           }
       }
       else
       {
           $message = "Mauvais pseudo ou mot de passe.";
           require('view/frontend/login.php');
       }
    }

    else
    {
        $message = "Vous devez remplir tous les champs pour vous connecter";
        require('view/frontend/login.php');
    }
}

function showUserLogin()
{
    if(isset($_SESSION['user']))
        return showUserAlreadyLogged();

    $title = "Connexion";
    require('view/frontend/login.php');
}