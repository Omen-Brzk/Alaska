<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/10/2018
 * Time: 23:10
 */

require_once ('tools.php');

require('controller/postController.php');
require('controller/commentController.php');
require('controller/userController.php');
require('controller/adminController.php');

session_start();

$action = '';

if(isset($_GET['action']))
{
    if($_GET['action'] == 'showPost' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        showPostById($_GET['id']);
    }

    elseif ($_GET['action'] == 'register' && !isset($_SESSION['user']))
    {
        if(isset($_POST['submit']))
        {
            sendUserRegister($_POST);
        }
        else
        {
            showRegister();
        }
    }

    elseif($_GET['action'] == 'showAccount')
    {
        if(isset($_SESSION['user']))
        {
            showUserAccount($_SESSION['user']);
        }
    }

    elseif($_GET['action'] == 'login')
    {
        if(isset($_POST['submit']))
        {
            sendUserLogin($_POST);
        }
        else
        {
            showUserLogin();
        }
    }

    elseif($_GET['action'] == 'disconnect')
    {
        userDisconnect();
    }
}
else
{
    showAllPost();
}