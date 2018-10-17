<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 15/10/2018
 * Time: 16:27
 */

function admin_showPanel()
{
    $userManager = new UserManager();
    $userList = $userManager->getAllUser();

    $commentManager = new CommentManager();
    $commentList = $commentManager->getAllReportComment();

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
