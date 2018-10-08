<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 08/10/2018
 * Time: 10:18
 */

require_once ('tools.php');
spl_autoload_register('loadClass');

class CommentManager extends Database
{
    private $_db;

    /**
     * CommentManager constructor.
     */
    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createComment(Comment $comment)
    {
        $req = $this->_db->prepare('INSERT INTO comments(post_id, author, comment_text, comment_date, reports) VALUES (:postId, :author, :commentText, :commentDate, :reports)');

        $req->bindValue(':postId' , $comment->getPostId());
        $req->bindValue(':author' , $comment->getAuthor());
        $req->bindValue(':commentText' , $comment->getComment());
        $req->bindValue(':commentDate' , $comment, new DateTime());
        $req->bindValue(':reports' , $comment->getReports());

        return $req->execute();
    }

    public function updateComment(Comment $comment)
    {
        $req = $this->_db->prepare('UPDATE comments SET  post_id = :postId, author = :author, comment_text = :commentText, reports = :reports WHERE id = ' . $comment->getId());

        $req->bindValue(':postId' , $comment->getPostId());
        $req->bindValue(':author' , $comment->getAuthor());
        $req->bindValue(':commentText' , $comment->getComment());
        $req->bindValue(':commentDate' , $comment, new DateTime());
        $req->bindValue(':reports' , $comment->getReports());

        return $req->execute();
    }

    public function deleteComment(Comment $comment)
    {
        return $req = $this->_db->exec('DELETE FROM comments WHERE id = ' . $comment->getId());
    }

    public function getCommentById($commentId)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE id = :commentId');
        $req->bindValue(':commentId' , (int)$commentId);

        $req->execute();

        $data = $req->fetch();

        if (is_array($data))
        {
            return new Comment($data);
        }
    }

    public function getAllCommentByPostId($postId)
    {
        $commentsList = [];

        $req = $this->_db->prepare('SELECT * FROM comments WHERE post_id = :postId');
        $req->bindValue(':postId' , (int)$postId);

        $req->execute();

        while($comment = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($commentsList, new Comment($comment));
        }

        if(!empty($commentsList))
        {
            return $commentsList;
        }
        else
        {
            return NULL;
        }
    }

    public function getAllComment()
    {
        $commentsList = [];

        $req = $this->_db->query('SELECT * FROM comments');

        while ($comment = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($commentsList, new Comment($comment));
        }
        $req->closeCursor();
        return $commentsList;
    }
}