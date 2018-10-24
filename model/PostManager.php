<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 08:43
 */

require_once ('tools.php');
spl_autoload_register('loadClass');

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
        $req = $this->_db->prepare('INSERT INTO posts(title, postRecap, content, creationDate) VALUES (:title, :postRecap, :content, NOW())');

        $req->bindValue(':title', htmlspecialchars($post->getTitle()));
        $req->bindValue(':postRecap', htmlspecialchars($post->getPostRecap()));
        $req->bindValue(':content', htmlspecialchars($post->getContent()));

        return $req->execute();
    }

    public function  updatePost(Post $post)
    {
        $req = $this->_db->prepare('UPDATE posts SET title = :title, content = :content, creationDate = :creationDate WHERE id = ' . $post->getId());

        $req->bindValue(':title', htmlspecialchars($post->getTitle()));
        $req->bindValue(':content', htmlspecialchars($post->getContent()));
        $req->bindValue(':creationDate', htmlspecialchars($post->getCreationDate()));

        return $req->execute();
    }

    public function deletePost(Post $post)
    {
        return $req = $this->_db->exec('DELETE FROM posts WHERE id = ' . $post->getId());
    }

    public function getPostById($id)
    {
        $req = $this->_db->prepare('SELECT *, DATE_FORMAT(creationDate, "Posté le %d/%m/%y à %H:%i:%s") AS creationDate FROM posts WHERE id = :id');
        $req->bindValue(':id', (int)$id);

        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        if (is_array($data))
        {
            return new Post($data);
        }
    }

    public function getAllPost()
    {
        $postsList = [];
        $req = $this->_db->query('SELECT *, DATE_FORMAT(creationDate, "Posté le %d/%m/%y à %H:%i:%s") AS creationDate FROM posts');

        while($post = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($postsList, new Post($post));
        }
        $req->closeCursor();
        return $postsList;
    }
}