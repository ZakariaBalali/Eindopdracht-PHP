<?php
session_start()
?>
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
    <a href="TicketPage.php">Tickets</a>
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
        <a class="active" href="Shoppingcart.php">Shopping Cart</a>
    </section>
</section>
<section class="Main" id="maincontent">

    <?php
    if (!empty($_SESSION['Products'])) { ?>

        <table id="CartTable">
            <tr id="TableHead">
                <th></th>
                <th>Airline</th>
                <th>From</th>
                <th>To</th>
                <th>Price</th>
            </tr>

            <?php
            $TotalPrice = 0;
            foreach ($_SESSION['Products'] as $item) {
                //Make a form for each item to delete them if needed
                ?>
                <form class="formAlter" action="AlterSession.php" method="post" id="AlterProduct">
                    <input style="display: none" class="valueEvent" name="eventID" type="text"
                           value="<?php echo $item['ticketID'] ?>"/><?php
                    ?>
                    <tr><?php
                        echo '<td><img src = "images/' . $item['image'] . '.png" alt="AirlineImage" title="AirlineLogo" class = "airlineLogo"></td>'; ?>
                        <td id="TabledataCart"><?php echo $item['airline']; ?> </td>
                        <td id="Tabledata1"><?php echo $item['flightFrom']; ?>
                            <br> <?php echo $timeFormat = date('D d F ', strtotime($item['timeDeparture'])); ?> </td>
                        <td id="Tabledata1"><?php echo $item['flightTo']; ?>

                            <br> <?php echo $timeFormat = date('D d F ', strtotime($item['timeArrival'])); ?> </td>

                        <td id="TabledataCart">&euro; <?php echo $item ['Price']; ?></td>
                    </tr>
                </form>
            <?php }
            ?>
        </table>

        <form class="formPayment" action="ShoppingCartPayment.php" method="post" id="GoToPayment">

            <button id="ProceedButton" form="GoToPayment" id="GoToPayment">
                Proceed to Details
            </button>
        </form>
    <?php } else {
        echo "Add items to your shopping cart so you can display them here!";
    } ?>


</section>


</body>
</html>
