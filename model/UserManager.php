<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 09/10/2018
 * Time: 23:05
 */

require_once ('tools.php');
spl_autoload_register('loadClass');

class UserManager extends Database
{
    private $_db;

    public function __construct()
    {
        $this->_db = parent::dbConnect();
        return $this->_db;
    }

    public function createUser(User $user)
    {
        $req = $this->_db->prepare('INSERT INTO users(username, userpass, dateSignin, groupId, mail) VALUES (:username, :userpass, NOW(), :groupId, :mail)');

        $req->bindValue(':username' , $user->getUsername());
        $req->bindValue(':userpass' , $user->getUserpass());
        $req->bindValue(':groupId' , $user->getGroupId());
        $req->bindValue(':mail' , $user->getMail());

        return $req->execute();
    }

    public function updateUser(User $user)
    {
        $req = $this->_db->prepare('UPDATE users SET username = :username, userpass = :userpass, groupId = :groupId, mail = :mail  WHERE id = ' . $user->getId());

        $req->bindValue(':username' , $user->getUsername());
        $req->bindValue(':userpass' , $user->getUserpass());
        $req->bindValue(':groupId' , $user->getGroupId());
        $req->bindValue(':mail' , $user->getMail());

        return $req->execute();
    }

    public function deleteUser(User $user)
    {
        return $req = $this->_db->exec('DELETE FROM users WHERE id =' . $user->getId());
    }

    public function getUserByNameOrId($parameter)
    {
        if(is_numeric($parameter))
        {
            $req = $this->_db->prepare('SELECT * FROM users WHERE id = :id');
            $req->bindValue(':id' , (int)$parameter);
        }
        else
        {
            $req = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
            $req->bindValue(':username' , (string)$parameter);
        }

        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if(is_array($data))
        {
            return new User($data);
        }


        $req->closeCursor();
    }

    public function usernameExist($username)
    {
        $req = $this->_db->prepare('SELECT * FROM users WHERE username = :username');
        $req->bindValue(':username' , (string)$username);

        $req->execute();

        if($req->rowCount() > 0)
            return true;
        else return false;
    }

    public function mailExist($mail)
    {
        $req = $this->_db->prepare('SELECT * FROM users WHERE mail = :mail');
        $req->bindValue(':mail', (string)$mail);

        $req->execute();

        if($req->rowCount() > 0)
            return true;
        else return false;
    }

    public function getAllUser()
    {
        $usersList = [];

        $req = $this->_db->query('SELECT * FROM users');

        while($user = $req->fetch(PDO::FETCH_ASSOC))
        {
            array_push($usersList, new User($user));
        }

        $req->closeCursor();
        return $usersList;
    }
}