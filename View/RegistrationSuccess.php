<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Wifi-Portal</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php'

?>

<section class="topnav">
    <img src="images/logo.png" alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a href="Homepage.php">Home</a>
    <?php
    if (isset($_SESSION['LoggedIn'])) {
        $user = $userLogic->SearchUserByEmail($_SESSION['email']);
        if ($user[0]->getIsAdmin() == 1) {
            echo '<a href="AdministrationUsers.php">Admin</a>';
        }


    }
    ?>
    <a href="TicketPage.php">Tickets</a>
    <a href="#contact">Contact</a>

    <section class="topnavRight">
        <a class="active" href="Register.php">Register</a>
        <?php
        if (isset($_SESSION['LoggedIn'])) {
            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo '<a href="Login.php">Login</a>';
        }

        ?>
    </section>
</section>


<section class="MainRegister" id="mainregister">
    <label>Registration successfull!</label>
    <a href="Login.php"><label>Click here to go to login page</label></a>
</section>


</body>
</html>
