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
require '../Logic/LoginLogic.php';

?>

<section class="topnav">
    <img src="images/logo.png"  alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a href="Homepage.php">Home</a>
    <a href="AdministrationUsers.php">Admin</a>
    <a href="#about">About</a>
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


<section class="MainRegister" id= "mainregister">
    <header class="titleHeaders">
        <h1>Registration form</h1></header>

    <section class="register-container">
        <form id = "registerForm" method="post">
            <label>First Name</label>
            <input type="text" placeholder="e.g John" name = "registerFirstName">
            <label>Last Name</label>
            <input type="text" placeholder="e.g Smith" name = "registerLastName">
            <label>Email</label>
            <input type="email" placeholder="e.g Johnsmith@gmail.com" name="registerEmail">
            <label>Password</label>
            <input type="password"  name="registerPassword">
            <button type="submit" name="register" form="registerForm" value="Submit">Register</button>
        </form>
    </section>



</body>
</html>
