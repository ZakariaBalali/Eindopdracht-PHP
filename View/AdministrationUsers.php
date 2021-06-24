<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';

$user = $userLogic->SearchUserByEmail($_SESSION['email']);


//checks if user is logged in and is admin
if (!isset($_SESSION['LoggedIn']) || $user[0]->getIsAdmin() == 0) {
    header('Location: ../View/Homepage.php');
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
    <a href="TicketPage.php">Tickets</a>
    <a href="images.php">Upload images</a>

    <section class="topnavRight">

        <?php
        //dynamically changes text from the login button when you're logged in
        if (isset($_SESSION['LoggedIn'])) {
            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo '<a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>
        <a href="Shoppingcart.php">Shopping Cart</a>
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
        <form id="downloadCsv" method="post">
            <button type="submit" name="downloadCsvBtn" form="downloadCsv" value="Submit">Download Csv</button>
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
            <th>Is Admin</th>
            <th>Make Admin</th>
            <th>Delete User</th>
        </tr>


        <?php
        //fills table depending on the button clicked and if you've searched for a specific person
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
        if(isset($_POST['downloadCsvBtn'])){

            header('Location: ../View/DownloadCsv.php');


        }


        foreach ($users as $user) {
            echo '<tr>';
            echo '<td>' . $user->getUserID() . '</td>';
            echo '<td>' . $user->getFirstName() . '</td>';
            echo '<td>' . $user->getLastName() . '</td>';
            echo '<td>' . $user->getEmail() . '</td>';
            echo '<td>' . $user->getIsAdmin() . '</td>';
            echo '<td><a href="MakeAdmin.php?UserID= ' . $user->GetUserID() . '"<button type="submit" name="makeAdmin" form="makeUserAdmin" value="Submit">Grant Admin</button></td></a>';

            echo '<td><a href="DeleteUsers.php?UserID= ' . $user->GetUserID() . '"<button type="submit" name="delete" form="deleteUser" value="Submit">Delete</button></td></a>';
            echo '</tr>';
        }
        ?>
    </table>

</section>


</body>
</html>
