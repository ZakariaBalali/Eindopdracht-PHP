<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
require '../Logic/LoginLogic.php';

?>

<section class="topnav">
    <img src="images/logo.png" alt="Airplane" title="AirplaneLogo" class="logoImage">
    <a class="active" href="Homepage.php">Home</a>
    <a href="AdministrationUsers.php">Admin</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>

    <section class="topnavRight">

        <?php
        //checks if user is logged in and shows corresponding buttons
        if (isset($_SESSION['LoggedIn'])) {

            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo'<a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>

    </section>
</section>


<section class="Main" id="maincontent">
    <header class="titleHeaders">
        <h1>Flight Tickets</h1></header>

    <article class="articleMain1">
        <p>Het Grootste Vluchtaanbod: +500 luchtvaartmaatschappijen en +3.000 bestemmingen! Vergelijk Alle Airlines en Alle Bestemmingen bij ons en boek nu snel Online! Scherpe aanbiedingen. Vergelijk en Boek. Experts sinds 1999.</p>
    </article>

</section>


</body>
</html>
