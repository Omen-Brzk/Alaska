<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 06/10/2018
 * Time: 23:35
 */

class Post
{
    private $_id ;
    private $_title;
    private $_content;
    private $_creationDate;

    /**
     * Post constructor.
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
    public function hydrate(array  $datas)
    {
        foreach  ($datas as $key => $value)
        {
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
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
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

        if($id > 0)
        {
            $this->_id = $id;
        }
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        if (is_string($title) && strlen($title) <= 255)
        {
            $this->_title = $title;
        }
    }

    /**
     * @param $content
     */
    public function setContent($content)
    {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }

    /**
     * @param $date
     */
    public function setCreationDate($date)
    {
        if (is_string($date) && strlen($date) < 255)
        {
            $this->_creationDate = $date;
        }
    }

}

