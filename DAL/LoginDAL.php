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
        $this->instance = Database::getInstance();
        $this->connection = $this->instance->getConnection();
        $this->userDAL = new UserDAL();
    }

    public function UserLogin($email, $password)
    {
        $user = $this->userDAL->GetUserByEmail($email);
        if ($user->password === $password) {
            return true;
        } else {
            return false;
        }
    }

    public function UserRegister($firstName, $lastName, $email, $password)
    {
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
