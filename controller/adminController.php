<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 15/10/2018
 * Time: 16:27
 */

require_once ('model/CommentManager.php');
require_once ('model/PostManager.php');
require_once('model/UserManager.php');

/**
 * ADMIN FUNCTIONS
 */

function admin_showPanel()
{
    $userManager = new UserManager();
    $userList = $userManager->getAllUser();
    $commentManager = new CommentManager();
    $commentList = $commentManager->getAllReportComment();
    $postManager = new PostManager();
    $postList = $postManager->getAllPostAdmin();
    $title = "Administration";
    require('view/backend/admin.php');
}

function unReportComment($commentId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $title = "Administration";

            $commentManager = new CommentManager();
            $comment = $commentManager->getCommentById($commentId);

            $comment->setReports(0);

            $commentManager->updateComment($comment);

            header('Location:index.php?action=showAccount');
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour effectuer cette action');
    }
}

function editUserComment($commentId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $commentManager = new CommentManager();
            $comment = $commentManager->getCommentById($commentId);
            $title = 'Modifier le commentaire';

            if(is_null($comment))
            {
                showError404('Le commentaire recherché est introuvable');
            }
            else
            {
                require('view/frontend/comment-edit.php');
            }
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour effectuer cette action');
    }

}

function sendUserEditComment($datas)
{
    $title = 'Modifier le commentaire';
    $commentManager = new CommentManager();
    $comment = $commentManager->getCommentById($datas['commentId']);

    if($datas['commentText'] != "")
    {
        if($datas['commentText'] != $comment->getCommentText())
        {
            $comment->setCommentText($datas['commentText']);
            $commentManager->updateComment($comment);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Le commentaire a bien été modifié !</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';

            $userManager = new UserManager();
            $userList = $userManager->getAllUser();

            $commentManager = new CommentManager();
            $commentList = $commentManager->getAllReportComment();

            $postManager = new PostManager();
            $postList = $postManager->getAllPost(5,0);

            $title = "Administration";

            return require ('view/backend/admin.php');
        }
        else
        {
            admin_showPanel();
        }
    }
    else
    {
        $message = '<div class="alert alert-danger">Veuillez rentrer un commentaire</div>';
        return require('view/frontend/comment-edit.php');
    }
}

function deleteUserComment($commentId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $commentManager = new CommentManager();
            $comment = $commentManager->getCommentById($commentId);

            if(is_null($comment))
            {
                showError404('Le commentaire recherché est introuvable');
            }
            else
            {
                $commentManager->deleteComment($comment);
                $userManager = new UserManager();
                $userList = $userManager->getAllUser();
                $commentManager = new CommentManager();
                $commentList = $commentManager->getAllReportComment();
                $postManager = new PostManager();
                $postList = $postManager->getAllPost(5,0);
                $title = "Administration";
                header('Location:index.php?action=showAccount');
            }
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à accéder à cette page');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour accéder à cette page');
    }

}

function editUser($userId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $userManager = new UserManager();
            $user = $userManager->getUserByNameOrId($userId);

            if(is_null($user))
            {
                showError404('L\'utilisateur recherché n\'existe pas');
            }
            else
            {
                $title = 'Edition de l\'utilisateur : ' . $user->getUsername() .'';
                require('view/backend/user-edit.php');
            }
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à accéder à cette page');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour accéder à cette page');
    }
}

function sendUserEdit($datas)
{
    $userManager = new UserManager();
    $user = $userManager->getUserByNameOrId($_GET['id']);

    $user->setUsername($datas['username']);
    $user->setMail($datas['mail']);

    $userManager->updateUser($user);

    $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>L\'utilisateur a bien été modifié !</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

    $userManager = new UserManager();
    $userList = $userManager->getAllUser();

    $commentManager = new CommentManager();
    $commentList = $commentManager->getAllReportComment();

    $postManager = new PostManager();
    $postList = $postManager->getAllPost(5,0);

    $title = "Administration";

    require('view/backend/admin.php');
}

function promoteUser($userId, $groupId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $userManager = new UserManager();
            $user = $userManager->getUserByNameOrId($userId);
            $user->setGroupId($groupId);
            $userManager->updateUser($user);
            header('Location:index.php?action=showAccount');
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour effectuer cette action');
    }

}

function deleteUser($userId)
{
    if(isset($_SESSION['user']))
    {
        if($_SESSION['user']->getGroupId() != User::IS_USER)
        {
            $userManager = new UserManager();
            $user = $userManager->getUserByNameOrId($userId);
            $userManager->deleteUser($user);
            header('Location:index.php?action=showAccount');
        }
        else
        {
            showError404('Vous n\'êtes pas autorisé à effectuer cette action');
        }
    }
    else
    {
        showError404('Vous devez être connecté pour effectuer cette action');
    }
}

/**
 * AUTHOR FUNCTIONS
 */

function createPost($datas)
{
    $title = 'Creation d\'article';
    $postManager = new PostManager();

    if(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR)
    {
        if(!empty($datas['content']) && !empty($datas['postRecap']) && !empty($datas['title']))
        {
            $postArray = array(
                'title' => $datas['title'],
                'postRecap' => $datas['postRecap'],
                'content' => $datas['content'],

            );

            $post = new Post($postArray);

            if(preg_match('/(<script>)/', $datas['title']) || preg_match('/(<script>)/', $datas['postRecap']) || preg_match('/(<script>)/', $datas['content']))
            {
                $message = '<div class="alert alert-danger">L\'insertion de script n\'est pas autorisée, pour plus d\'information, consultez le développeur</div>';

                return require('view/backend/post-add.php');
            }

            $postManager->createPost($post);

            $userManager = new UserManager();
            $userList = $userManager->getAllUser();

            $commentManager = new CommentManager();
            $commentList = $commentManager->getAllReportComment();

            $postManager = new PostManager();
            $postList = $postManager->getAllPost(5,0);

            $title = "Administration";

            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Votre Article a bien été créé !</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

            require('view/backend/admin.php');
        }
        else
        {
            require('view/backend/post-add.php');
        }
    }
    else
    {
      showError404('Vous n\'êtes pas autorisé à accéder à cette page.');
    }
}

function showPostEdit($postId) {

    if(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR)
    {
        $title = 'Edition de l\'article';
        $postManager = new PostManager();
        $post = $postManager->getPostById($postId);
        require('view/backend/post-edit.php');
    }
    else
    {
        showError404('Vous n\'êtes pas autorisé à accéder à cette page');
    }
}

function sendPostEdit($datas)
{
    $postManager = new PostManager();
    $post = $postManager->getPostById($_GET['id']);

    $post->setTitle($datas['title']);
    $post->setPostRecap($datas['postRecap']);
    $post->setContent($datas['content']);

    $postManager->updatePost($post);

    $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Votre Article a bien été modifié !</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';

    $userManager = new UserManager();
    $userList = $userManager->getAllUser();

    $commentManager = new CommentManager();
    $commentList = $commentManager->getAllReportComment();

    $postManager = new PostManager();
    $postList = $postManager->getAllPost(5,0);

    $title = "Administration";

    require('view/backend/admin.php');
}

function deletePost($postId)
{
    if(isset($_SESSION['user']) && $_SESSION['user']->getGroupId() == User::IS_AUTHOR)
    {
        $postManager = new PostManager();
        $post = $postManager->getPostById($postId);

        $postManager->deletePost($post);

        header('Location:index.php?action=showAccount');
    }
    else
    {
        showError404('Vous n\'êtes pas autorisé à accéder à cette page');
    }
}

