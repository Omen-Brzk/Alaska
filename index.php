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

    elseif ($_GET['action'] == 'createPost')
    {
        createPost($_POST);
    }

    elseif ($_GET['action'] == 'editPost')
    {
        if(isset($_POST['submit']))
        {
            sendPostEdit($_POST);
        }
        else
        {
            showPostEdit($_GET['id']);
        }

    }

    elseif($_GET['action'] == 'deletePost' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        deletePost($_GET['id']);
    }

    elseif($_GET['action'] == 'editUser' && isset($_GET['id']) > 0)
    {
        if(isset($_POST['submit']))
        {
            sendUserEdit($_POST);
        }
        else
        {
            editUser($_GET['id']);
        }
    }

    elseif($_GET['action'] == 'promoteUser' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        promoteUser($_GET['id'], $_GET['groupid']);
    }

    elseif($_GET['action'] == 'deleteUser' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        deleteUser($_GET['id']);
    }

    elseif($_GET['action'] == 'editUserComment' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        if (isset($_POST['submit']))
        {
            sendUserEditComment($_POST);
        }
        else
        {
            editUserComment($_GET['id']);
        }
    }

    elseif($_GET['action'] == 'deleteUserComment' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        deleteUserComment($_GET['id']);
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
        unReportComment($_GET['commentId']);
    }

    elseif($_GET['action'] == 'showAccount')
    {
        showUserAccount();
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

    else
    {
        showError404("Page introuvable");
    }
}
elseif(isset($_GET['page']))
{
    showAllPost($_GET['page']);
}
else
{
    showAllPost();
}