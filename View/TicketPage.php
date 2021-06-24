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
    <a href="images.php">Upload images</a>

    <section class="topnavRight">

        <?php
        if (isset($_SESSION['LoggedIn'])) {
            echo '<a href="Logout.php">Logout</a>';
        } else {
            echo ' <a href="Register.php">Register</a>';
            echo '<a href="Login.php">Login</a>';
        }

        ?>
        <a href="Shoppingcart.php">Shopping Cart</a>
    </section>
</section>
<section>

    <?php
    //fills table with tickets
    $tickets = [];
    $ticketLogic = new TicketLogic();

    $tickets = (array)$ticketLogic->GetAllTickets();
    foreach ($tickets as $ticket) {
    ?>  <form action="../Logic/ShoppingCartLogic.php" method="post"
              id="AddToCart<?php echo $ticket->getTicketID()?>">
        <input style="display: none" class="valueArtist" name="ticketID" type="text"
               value="<?php echo $ticket->getTicketID(); ?>"/>
        <?php
        echo '<section className="wholeTicket">';
        echo '<section class="ticketDiv">';
        echo '<img src = "images/' . $ticket->getImage() . '.png" alt="AirlineImage" title="AirlineLogo" class = "airlineLogo"></td>';
        echo '<h1>' . $ticket->getAirline() . '</h1>';
        echo '<section>' . $ticket->getFlightFrom() . '</section>';
        echo '<div>' .$ticket->getFlightTo(). '</section>';
        echo '<div>' .$ticket->getTimeDeparture(). '</section>';
        echo '<div>' .$ticket->getTimeArrival(). '</section>';
        echo '<div>' .$ticket->getPrice(). '</section>';
        ?> <button form="AddToCart<?php echo $ticket->getTicketID()?>" type="submit"
                   name="AddToShoppingCart" value="submit"
                   class="AddToCartButton"
                   id="AddToCartButton<?php echo $ticket->getTicketID()?>">Add ticket to shopping cart</button><?php
        echo '</div>';
        echo '</div>';
        echo '</form>';
        }
        ?>
</section>


</body>
</html>
