<?php
require_once dirname(__FILE__) . '/../DAL/UserDAL.php';

class UserLogic
{
    private $userDAL;

    function __construct()
    {
        $this->userDAL = new UserDAL();
    }

    function CloseConnection()
    {
        $this->userDAL->dbCloseConnection();
    }

    function GetAllUsers()
    {
        return $this->userDAL->GetAllUsers();
    }

    function DeleteUser($id)
    {
        return $this->userDAL->DeleteUser($id);

    }

    function MakeAdmin($id)
    {
        return $this->userDAL->MakeAdmin($id);
    }

    function GetUserByEmail($email)
    {
        return $this->userDAL->GetUserByEmail($email);
    }

    function SearchUserByName($name)
    {
        return $this->userDAL->SearchUserByName($name);
    }

    function SearchUserByEmail($email)
    {
        return $this->userDAL->SearchUserByEmail($email);
    }

    function UserPasswordReset($email)
    {
        return $this->userDAL->UserPasswordReset($email);
    }


}

?>
