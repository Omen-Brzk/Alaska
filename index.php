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
        if(isset($_POST['submit']) && isset($_SESSION['user']))
        {
            addComment($_POST);
        }
        else
        {
            showPostById($_GET['id']);
        }

    }

    elseif($_GET['action'] == 'commentEdit' && isset($_GET['commentId']))
    {
        if(isset($_POST['submit']))
        {
            sendCommentEdit($_POST);
        }
        else
        {
            showCommentEdit($_GET['commentId']);
        }

    }

    elseif($_GET['action'] == 'reportComment' && isset($_GET['commentId']))
    {
        reportComment($_GET['commentId']);
    }

    elseif($_GET['action'] == 'unReportComment' && isset($_GET['commentId']))
    {
        if(isset($_SESSION['user']) && $_SESSION['user']->getId() > 1)
        {
            unReportComment($_GET['commentId']);
        }
        else
        {
            showAllPost();
        }
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