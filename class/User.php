<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 09/10/2018
 * Time: 22:37
 */

class User
{
    private $_id;
    private $_username;
    private $_userpass;
    private $_dateSignin;
    private $_groupId;
    private $_mail;

    CONST IS_USER = 1;
    CONST IS_AUTHOR = 2;
    CONST IS_ADMIN = 3;

    /**
     * User constructor.
     * @param array $datas
     * @throws Exception
     */
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    /**
     * @param array $datas
     * @throws Exception
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
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return mixed
     */
    public function getUserpass()
    {
        return $this->_userpass;
    }

    /**
     * @return mixed
     */
    public function getDateSignin()
    {
        return $this->_dateSignin;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        if($this->_groupId != NULL)
        {
            if($this->_groupId == 1)
                return $this::IS_USER;
            else if($this->_groupId == 2)
                return $this::IS_AUTHOR;
            else if($this->_groupId == 3)
                return $this::IS_ADMIN;

            else return $this::IS_USER;
        }
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->_mail;
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
            $this->_id = $id;
    }

    /**
     * @param $date
     */
    public function setDateSignin($date)
    {
        if(is_string($date))
        {
            $this->_dateSignin = $date;
        }
    }
    /**
     * @param $username
     */
    public function setUsername($username)
    {
        if(is_string($username) && strlen($username) < 50)
            $this->_username = $username;
    }

    /**
     * @param $userpass
     */
    public function setUserpass($userpass)
    {
        if(is_string($userpass))
            $this->_userpass = $userpass;
    }

    /**
     * @param $groupId
     */
    public function setGroupId($groupId)
    {
        $groupId = (int) $groupId;

        if($groupId > 0)
            $this->_groupId = $groupId;
    }

    /**
     * @param $mail
     */
    public function setMail($mail)
    {
        if(is_string($mail) && strlen($mail) < 255)
            $this->_mail = $mail;
    }


}