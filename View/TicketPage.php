<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <meta name="description" content="Flight Tickets">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
require_once '../Logic/LoginLogic.php';
require_once '../Logic/UserLogic.php';
require_once '../Logic/TicketLogic.php';
require_once '../DAL/TicketDAL.php';
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
    <a class="active" href="TicketPage.php">Tickets</a>
    <a href="#contact">Contact</a>

    <section class="topnavRight">

        <?php
        if (isset($_SESSION['LoggedIn'])) {
            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo ' <a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>
    </section>
</section>
<section class="Main" id="maincontent">
    <table class="Users">

        <tr>
            <th></th>
            <th>Airline</th>
            <th>Flight From</th>
            <th>Flight To</th>
            <th>Time Departure</th>
            <th>Time Arrival</th>
            <th>Price</th>
            <th></th>
        </tr>


        <?php
        //fills table with tickets
        $tickets = [];
        $ticketLogic = new TicketLogic();

        $tickets= (array)$ticketLogic->GetAllTickets();
        foreach ($tickets as $ticket) {
            echo '<tr>';
            echo '<td><img src = "images/' . $ticket->getImage() . '.png" alt="AirlineImage" title="AirlineLogo" class = "airlineLogo"></td>';
            echo '<td>' . $ticket->getAirline() . '</td>';
            echo '<td>' . $ticket->getFlightFrom() . '</td>';
            echo '<td>' . $ticket->getFlightTo() . '</td>';
            echo '<td>' . $ticket->getTimeDeparture() . '</td>';
            echo '<td>' . $ticket->getTimeArrival() . '</td>';
            echo '<td>€' . $ticket->getPrice() . '</td>';
            echo '<td><a href"#buytickets"><button type="submit" name="buy" form="buyTickets" value="Submit">Add ticket to shopping cart</button></a>';
            echo '</tr>';
        }
        ?>
    </table>
</section>


</body>
</html>
