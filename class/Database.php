<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 05/10/2018
 * Time: 23:27
 */


class Database
{
    /**
     * @return PDO
     */
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=p3_blog;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}