<?php
require_once dirname(__FILE__) . '/../Model/User.php';
require_once dirname(__FILE__) . '/DbConnection.php';

class UserDAL
{
    private $connection;
    private $instance;

    //makes the connection to the database
    function __construct()
    {
        $this->instance = Database::getInstance();
        $this->connection = $this->instance->getConnection();
    }

    //Closes the connection to the database
    function dbCloseConnection()
    {
        $this->Database->closeConnection();
    }

    //Gets user info from db and puts values into array
    function GetAllUsers()
    {
        $sql = "SELECT * FROM users";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];
                $isAdmin = $row['isAdmin'];

                $user = new User($id, $firstName, $lastName, $email, $password, $isAdmin);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }
    //Deletes user from database with a prepared statement
    function DeleteUser($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE userID = ?");
        $stmt->bind_param("i", $id);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //Grants admin status to user
    function MakeAdmin($id){
        $stmt = $this->connection->prepare("UPDATE users SET isAdmin = '1' where userID = '$id'");
        $stmt->bind_param("i", $id);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Gets user from database with a prepared statement for the login process
    public function GetUserByEmail($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        try {
            $stmt->execute();
            $user = $stmt->get_result();
            return $user->fetch_object();
        } catch (PDOException $e) {
            return null;
        }
    }
    //Gets users with a certain firstname or lastname from the database using escape string to prevent sql injection
    public function SearchUserByName($name)
    {
        $name = mysqli_real_escape_string($this->connection, $name);
        $sql = "SELECT userID, firstName, lastName, email, password, isAdmin FROM users WHERE firstName like '$name' or  lastName like '$name'";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];
                $isAdmin = $row['isAdmin'];
                $user = new User($id, $firstName, $lastName, $email, $password, $isAdmin);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }
    //Gets users with a certain email from the database using escape string to prevent sql injection
    public function SearchUserByEmail($email)
    {
        $email = mysqli_real_escape_string($this->connection, $email);
        $sql = "SELECT userID, firstName, lastName, email, password, isAdmin FROM users WHERE email like '$email'";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];
                $isAdmin = $row['isAdmin'];
                $user = new User($id, $firstName, $lastName, $email, $password, $isAdmin);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }
    //Resets password from a certain email address, uses escape string to prevent sql injection and a randomizer to get a random new password
    public function UserPasswordReset($email)
    {
        $newPassword = $this->generateRandomString(10);
        $email = mysqli_real_escape_string($this->connection, $email);
        $sql = "UPDATE users SET password = '$newPassword' where email like '$email'";
        $this->sendNewPasswordToEmail($newPassword, $email);
        return mysqli_query($this->connection, $sql);
    }
    //generates random string for the new password
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    //Sends new password to email address
    function sendNewPasswordToEmail($newPassword, $email)
    {
        $subject = "Your new password";
        // the message
        $content = "Your new password is " . $newPassword;
        // send email
        mail($email, $subject, $content);
    }

}

?>
