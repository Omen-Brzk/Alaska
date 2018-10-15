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

function ShowCommentEdit($commentId)
{
    $commentManager = new CommentManager();
    $commentAdd = $commentManager->getCommentById($commentId);

}

