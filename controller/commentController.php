<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 15:39
 */

require_once ('model/CommentManager.php');
require_once ('model/PostManager.php');
require_once('model/UserManager.php');

function showCommentEdit($commentId)
{
    $title = 'Modifier le commentaire';
    $commentManager = new CommentManager();
    $comment = $commentManager->getCommentById($commentId);

    if(!isset($_SESSION['user']))
    {
        return showError404('Vous devez être connecté pour accéder à cette page !');
    }

    if(is_null($comment))
    {
        return showError404('Impossible de trouver le commentaire');
    }

    if($_SESSION['user']->getId() != $comment->getAuthorId())
    {
        return showError404('Vous n\'êtes pas autorisé à modifier ce commentaire');
    }

    require('view/frontend/comment-edit.php');
}

function sendCommentEdit($datas)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getCommentById($datas['commentId']);

    if(!isset($_SESSION['user']))
    {
        return showError404('Vous devez être connecté pour accéder à cette page !');
    }

    if(is_null($comment))
    {
        return showError404('Impossible de trouver le commentaire');
    }

    if($_SESSION['user']->getId() <= 1)
    {
        return showError404('Vous n\'êtes pas autorisé à modifier ce commentaire');
    }

    if($datas['commentText'] != "")
    {
        if($datas['commentText'] != $comment->getCommentText())
        {
            $comment->setCommentText($datas['commentText']);
            $commentManager->updateComment($comment);
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Votre commentaire a bien été modifié !</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
        }
    }
    else
    {
        $message = 'Veuillez rentrer un commentaire';
        return require('view/frontend/comment-edit.php');
    }


    $postManager = new PostManager();
    $post = $postManager->getPostById($comment->getPostId());

    $comments = $commentManager->getAllCommentByPostId($comment->getPostId());

    $userManager = new UserManager();

    require('view/frontend/post.php');
}

function addComment($datas)
{
    $commentManager = new CommentManager();

    if(!empty($datas['commentText']))
    {
        $commentArray = array(
            'postId' => $datas['postId'],
            'authorId' => $_SESSION['user']->getId(),
            'CommentText' => $datas['commentText']
        );

        $comment = new Comment($commentArray);
        $commentManager->createComment($comment);
    }
    else
    {
        $message = 'Vous devez écrire un commentaire';
    }

    $postManager = new PostManager();
    $post = $postManager->getPostById($datas['postId']);

    $comments = $commentManager->getAllCommentByPostId($datas['postId']);

    $userManager = new UserManager();

    require('view/frontend/post.php');

}

function reportComment($commentId)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getCommentById($commentId);

    $comment->setReports(1);

    $commentManager->updateComment($comment);

    header('Location:index.php?action=showPost&id=' . $comment->getPostId());
}



