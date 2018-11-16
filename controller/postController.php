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

function showAllPost($page = 0)
{
    $postManager = new PostManager();

    $maxPost = 5;
    $pages = round((int)$postManager->getPostsCount() / $maxPost, 1, PHP_ROUND_HALF_UP);

    $posts = $postManager->getAllPost($maxPost, $page * 5);

    $title = 'Accueil';

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
        return showError404('L\' article demandé n\'existe pas.');
    }

    require('view/frontend/post.php');
}




