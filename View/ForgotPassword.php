<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';

$userLogic = new UserLogic();

if (isset($_POST['passwordReset']))
{

    //uses email from the textbox to reset your password
    $email = $_POST['resetEmail'];
    if ($userLogic->UserPasswordReset($email)) {

        header('Location: ../View/PasswordResetSuccess.php');

    } else {
        echo "<script>alert('There was en error while resetting your password')</script>";
    }
};


?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<section class="topnav">
    <img src="images/logo.png"  alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a href="Homepage.php">Home</a>
    <a href="AdministrationUsers.php">Admin</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>

    <section class="topnavRight">

        <?php
        if (isset($_SESSION['LoggedIn'])) {

            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo'<a href="Register.php">Register</a>';
            echo '<a class = "active" href="Login.php">Login</a>';
        }

        ?>
    </section>
</section>


<section class="MainLogin" id= "mainlogin">
    <header class="titleHeaders">
        <h1>Login</h1></header>

    <section class="login-container">
        <form id = "passwordForm" method="post">
            <label>Fill in your email to reset your password</label>
            <input type="email" placeholder="example@example.com" name="resetEmail">

            <button type="submit" name="passwordReset" form="passwordForm" value="Submit">Reset</button>
        </form>
    </section>
</section>


</body>
</html>
