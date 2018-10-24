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
    $postList = $postManager->getAllPost();

    $title = "Administration";

    require('view/backend/admin.php');
}

function unReportComment($commentId)
{
    $title = "Administration";

    $commentManager = new CommentManager();
    $comment = $commentManager->getCommentById($commentId);

    $comment->setReports(0);

    $commentManager->updateComment($comment);

    header('Location:index.php?action=showAccount');
}

/**
 * AUTHOR FUNCTIONS
 */

function createPost($datas)
{
    $title = 'Creation d\'article';
    $postManager = new PostManager();

    /**
     * TODO REGEX SCRIPT XSS
     */
    if(!empty($datas['content']) && !empty($datas['postRecap']) && !empty($datas['title']))
    {
        $postArray = array(
            'title' => $datas['title'],
            'postRecap' => $datas['postRecap'],
            'content' => $datas['content'],

        );

        $post = new Post($postArray);
        $postManager->createPost($post);

        $userManager = new UserManager();
        $userList = $userManager->getAllUser();

        $commentManager = new CommentManager();
        $commentList = $commentManager->getAllReportComment();

        $postManager = new PostManager();
        $postList = $postManager->getAllPost();

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

function showPostEdit($postId) {

    $title = 'Edition de l\'article';
    $postManager = new PostManager();
    $post = $postManager->getPostById($postId);

    require('view/backend/post-edit.php');
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
    $postList = $postManager->getAllPost();

    $title = "Administration";

    require('view/backend/admin.php');
}

function deletePost($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPostById($postId);

    $postManager->deletePost($post);

    header('Location:index.php?action=showAccount');
}

