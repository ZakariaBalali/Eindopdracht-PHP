<?php
include 'DbConnection.php';
include 'UserDAL.php';
class LoginDAL
{
    private $connection;
    private $instance;
    private $userDAL;
    public function __construct()
    {
        $this->instance = DbConnection::getInstance();
        $this->connection = $this->instance->getConnection();
        $this->userDAL = new UserDAL();
    }

    //Goes through the login process
    public function UserLogin($email, $password)
    {
        //chechs if email exists
        $user = $this->userDAL->GetUserByEmail($email);
        //checks the password
        if ($user->password === $password) {
            return true;
        } else {
            return false;
        }
    }
    //goes through the registration process
    public function UserRegister($firstName, $lastName, $email, $password)
    {
        //uses prepared statements for the registration
        $stmt = $this->connection->prepare("INSERT INTO users  (firstName, lastName, email, password) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }



}

?>
