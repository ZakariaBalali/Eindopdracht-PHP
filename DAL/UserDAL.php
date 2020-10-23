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
    function GetAllUsersDB()
    {
        $sql = "SELECT userID, firstName, lastName, email, password FROM users";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];

                $user = new User($id, $firstName, $lastName, $email, $password);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }

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


    public function SearchUserByName($name)
    {
        $name = mysqli_real_escape_string($this->connection, $name);
        $sql = "SELECT userID, firstName, lastName, email, password FROM users WHERE firstName like '$name' or  lastName like '$name'";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];

                $user = new User($id, $firstName, $lastName, $email, $password);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }

    public function SearchUserByEmail($email)
    {
        $email = mysqli_real_escape_string($this->connection, $email);
        $sql = "SELECT userID, firstName, lastName, email, password FROM users WHERE email like '$email'";

        $users = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["userID"];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $email = $row["email"];
                $password = $row['password'];

                $user = new User($id, $firstName, $lastName, $email, $password);
                $users[] = $user;
            }
            return $users;
        } else {
            echo 'no users found';
        }
    }

}

?>
