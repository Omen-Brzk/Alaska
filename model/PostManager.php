<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 08:43
 */

require_once ('../tools.php');
spl_autoload('loadClass');

class PostManager extends Database
{
    private $_db;

    /**
     * PostManager constructor.
     */
    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createPost(Post $post)
    {
        $req = $this->_db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (:title, :content, :creation_date)');

        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':content', $post->getContent());
        $req->bindValue(':creation_date', new DateTime());

        return $req->execute();
    }

    public function  updatePost(Post $post)
    {
        $req = $this->_db->prepare('UPDATE posts SET title = :title, content = :content, creation_date = :creation_date WHERE id = ' . $post->getId());

        $req->bindValue(':title', $post->getTitle());
        $req->bindValue(':content', $post->getContent());
        $req->bindValue(':creation_date', new DateTime());

        return $req->execute();
    }

    public function deletePost(Post $post)
    {
        return $req = $this->_db->exec('DELETE FROM posts WHERE id = ' . $post->getId());
    }

    public function getPostById($id)
    {
        $req = $this->_db->prepare('SELECT * FROM posts WHERE id = :id');
        $req->bindValue(':id', (int)$id);

        $req->execute();

        $data = $req->fetch();

        if (is_array($data))
        {
            return new Post($data);
        }
    }

    public function getAllPost()
    {
        $req = $this->_db->prepare('SELECT * FROM posts');

        while($post = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($postsList, new Post($post))
        }

        return $postsList;
    }
}