<?php
require_once '../Logic/LoginLogic.php';

//checks if user is logged in
if (!isset($_SESSION['LoggedIn'])) {
    header('Location: ../View/Login.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<section class="topnav">
    <img src="images/logo.png" alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a href="Homepage.php">Home</a>
    <a class="active" href="AdministrationUsers.php">Admin</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>

    <section class="topnavRight">

        <?php
        if (isset($_SESSION['LoggedIn'])) {
            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo '<a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>
    </section>
</section>

<section class="Secondary" id="secondarycontent">


    <section class="search-container">
        <form id="ShowAllUserForm" method="post">
            <label>Show All users</label>
            <button type="submit" name="showAllBtn" form="ShowAllUserForm" value="Submit">Show All Users</button>
        </form>
        <form id="searchEmailForm" method="post">
            <label>Search by email</label>
            <input type="email" placeholder="example@example.com" name="searchEmail">
            <button type="submit" name="searchEmailBtn" form="searchEmailForm" value="Submit">Search by email</button>
        </form>
            <form id="searchNameForm" method="post">
                <label>Search by name (both first name and last name)</label>
                <input type="text" placeholder="e.g. John" name="searchName">
                <button type="submit" name="searchNameBtn" form="searchNameForm" value="Submit">Search by name</button>
            </form>
    </section>

</section>


<section class="Main" id="maincontent">

    <table class="Users">

        <tr>
            <th>id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>password</th>
            <th>Delete User</th>
        </tr>


        <?php
        require_once '../Logic/UserLogic.php';
        $users = [];
        $userLogic = new UserLogic();
        if (isset($_POST['showAllBtn'])) {

            $users = (array)$userLogic->GetAllUsers();
        }


        if (isset($_POST['searchEmailBtn'])) {

            $users = (array)$userLogic->SearchUserByEmail($_POST['searchEmail']);

        }


        if (isset($_POST['searchNameBtn'])) {

            $users = (array)$userLogic->SearchUserByName($_POST['searchName']);

        }

        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user->GetUserID() . '</td>';
            echo '<td>' . $user->GetFirstName() . '</td>';
            echo '<td>' . $user->GetLastName() . '</td>';
            echo '<td>' . $user->GetEmail() . '</td>';
            echo '<td>' . $user->GetPassword() . '</td>';

            echo '<td><a href="DeleteUsers.php?UserID= ' . $user->GetUserID() . '"<button type="submit" name="delete" form="deleteUser" value="Submit">Delete</button></td></a>';
            echo '</tr>';
        }
        ?>
    </table>

</section>


</body>
</html>
