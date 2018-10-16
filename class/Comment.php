<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 07/10/2018
 * Time: 00:09
 */

class Comment
{
    private $_id;
    private $_postId;
    private $_authorId;
    private $_commentText;
    private $_commentDate;
    private $_reports;

    /**
     * Comment constructor.
     * @param array $datas
     */
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    /**
     * Hydrate function
     * @param array $datas
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method))
                $this->$method($value);
            else throw new Exception("Exception | " . $method . "() : La méthode invoquée n'existe pas");
        }
    }

    /**
     * GETTERS
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->_postId;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->_authorId;
    }

    /**
     * @return mixed
     */
    public function getCommentText()
    {
        return $this->_commentText;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->_commentDate;
    }

    /**
     * @return mixed
     */
    public function getReports()
    {
        return $this->_reports;
    }

    /**
     * SETTERS
     */

    /**
     * @param $id
     */
    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0)
        {
            $this->_id = $id;
        }
    }

    /**
     * @param $postId
     */
    public function setPostId($postId)
    {
        $postId = (int) $postId;

        if ($postId > 0)
        {
            $this->_postId = $postId;
        }
    }

    /**
     * @param $author
     */
    public function setAuthorId($authorId)
    {
        if (is_numeric($authorId) && $authorId > 0)
        {
            $this->_authorId = $authorId;
        }
    }

    /**
     * @param $comment
     */
    public function setCommentText($comment)
    {
        if (is_string($comment))
        {
            $this->_commentText = $comment;
        }
    }

    /**
     * @param $date
     */
    public function setCommentDate($date)
    {
        if (is_string($date))
        {
            $this->_commentDate = $date;
        }
    }

    /**
     * @param $reports
     */
    public function setReports($reports)
    {
        $reports = (int) $reports;

        if ($reports >= 0)
        {
            $this->_reports = $reports;
        }
    }

}