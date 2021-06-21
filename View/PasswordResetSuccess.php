<?php
require '../Logic/LoginLogic.php';
require '../Logic/UserLogic.php'
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
    <?php
    if(isset($_SESSION['LoggedIn'])){
        $user = $userLogic->SearchUserByEmail($_SESSION['email']);
        if ($user[0]->getIsAdmin() == 1) {
            echo '<a href="AdministrationUsers.php">Admin</a>';
        }


    }
    ?>
    <a href="TicketPage.php">Tickets</a>
    <a href="images.php">Upload images</a>

    <section class="topnavRight">

        <?php
        if (isset($_SESSION['LoggedIn'])) {

            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo'<a href="Register.php">Register</a>';
            echo '<a class = "active" href="Login.php">Login</a>';
        }

        ?>
        <a href="Shoppingcart.php">Shopping Cart</a>
    </section>
</section>


<section class="MainLogin" id= "mainlogin">
    <header class="titleHeaders">
        <h1>Password reset successful</h1></header>

    <section class="login-container">
        <label>Your new password has been sent to your email address</label>
        <a href="Login.php" ><label>Click here to go to login page</label></a>
    </section>
</section>


</body>
</html>
