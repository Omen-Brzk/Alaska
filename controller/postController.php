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

function showAllPost()
{
    $postManager = new PostManager();
    $posts = $postManager->getAllPost();

    $title = 'Accueil';

    $maxPosts = 5;

    require('view/frontend/home.php');
}

function showPostById($postId)
{
    $postManager = new PostManager();
    $post = $postManager->getPostById($postId);

    $commentManager = new CommentManager();
    $comments = $commentManager->getAllCommentByPostId($postId);

    $userManager = new UserManager();

    if(is_null($post))
    {
        $error = 'L\' article demandé n\'existe pas.';
        return require('view/frontend/404.php');
    }

    require('view/frontend/post.php');
}




