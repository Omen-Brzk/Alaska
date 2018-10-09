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

session_start();

$action = '';

if(isset($_GET['action']))
{
    if($_GET['action'] == 'showPost' && isset($_GET['id']) && $_GET['id'] > 0)
    {
        showPostById($_GET['id']);
    }
}
else
{
    showAllPost();
}