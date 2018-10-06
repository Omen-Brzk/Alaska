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
    private $_post_id;
    private $_author;
    private $_comment;
    private $_comment_date;
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

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
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
        return $this->_post_id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->_comment_date;
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

        if ($id < 0)
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

        if ($postId < 0)
        {
            $this->_post_id = $postId;
        }
    }

    /**
     * @param $author
     */
    public function setAuthor($author)
    {
        if (is_string($author))
        {
            $this->_author = $author;
        }
    }

    /**
     * @param $comment
     */
    public function setComment($comment)
    {
        if (is_string($comment))
        {
            $this->_comment = $comment;
        }
    }

    /**
     * @param $date
     */
    public function setCommentDate($date)
    {
        if (is_string($date))
        {
            $this->_comment_date = $date;
        }
    }

    /**
     * @param $reports
     */
    public function setReports($reports)
    {
        $reports = (int) $reports;

        if ($reports < 0)
        {
            $this->_reports = $reports;
        }
    }

}