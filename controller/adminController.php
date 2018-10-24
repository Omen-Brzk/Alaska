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

function editPost($postId) {
    //TODO
}

function deletePost($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPostById($postId);

    $postManager->deletePost($post);

    header('Location:index.php?action=showAccount');
}

function createPost($datas)
{
    $title = 'Creation d\'article';
    $postManager = new PostManager();

    if(!empty($datas['content']) && !empty($datas['postRecap']) && !empty($datas['title']))
    {
        $postArray = array(
            'title' => $datas['title'],
            'postRecap' => $datas['postRecap'],
            'content' => $datas['content'],

        );

        $post = new Post($postArray);
        $postManager->createPost($post);
    }

    require('view/backend/post-add.php');
}