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
        <form id = "loginForm" method="post">
            <label>Email</label>
            <input type="email" placeholder="example@example.com" name="loginEmail">
            <label>Password</label>
            <input type="password"  name="loginPassword">
            <button type="submit" name="login" form="loginForm" value="Submit">Login</button>
            <label>Forgot Password?</label>
        </form>
    </section>
</section>


</body>
</html>
