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
        $req = $this->_db->prepare('INSERT INTO comments(postId, authorId, commentText, commentDate) VALUES (:postId, :authorId, :commentText, NOW())');

        $req->bindValue(':postId' , htmlspecialchars($comment->getPostId()));
        $req->bindValue(':authorId' , htmlspecialchars($comment->getAuthorId()));
        $req->bindValue(':commentText' , htmlspecialchars($comment->getCommentText()));

        $req->execute();
    }

    public function updateComment(Comment $comment)
    {
        $req = $this->_db->prepare('UPDATE comments SET  postId = :postId, authorId = :authorId, commentText = :commentText, reports = :reports WHERE id = ' . $comment->getId());

        $req->bindValue(':postId' , htmlspecialchars($comment->getPostId()));
        $req->bindValue(':authorId' , htmlspecialchars($comment->getAuthorId()));
        $req->bindValue(':commentText' , htmlspecialchars($comment->getCommentText()));
        $req->bindValue(':reports' , htmlspecialchars($comment->getReports()));

        return $req->execute();
    }

    public function deleteComment(Comment $comment)
    {
        return $req = $this->_db->exec('DELETE FROM comments WHERE id = ' . $comment->getId());
    }

    public function getCommentById($commentId)
    {
        $req = $this->_db->prepare('SELECT * FROM comments WHERE id = :commentId');
        $req->bindValue(':commentId' , htmlspecialchars((int)$commentId));

        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        if (is_array($data))
        {
            return new Comment($data);
        }
    }

    // SELECT *, DATE_FORMAT(commentDate, 'Posté le %d/%m/%y à %H:%i:%s') AS 'commentDateFr' FROM comments WHERE postId = 1 ORDER BY commentDate DESC
    public function getAllCommentByPostId($postId)
    {
        $commentsList = [];

        $req = $this->_db->prepare('SELECT *, DATE_FORMAT(commentDate, "Posté le %d/%m/%y à %H:%i:%s") AS commentDate FROM comments WHERE postId = :postId ORDER BY commentDate DESC');
        $req->bindValue(':postId' , htmlspecialchars((int)$postId));

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