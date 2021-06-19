<?php
require_once dirname(__FILE__) . '/../DAL/TicketDAL.php';
session_start();

// Music isset
if (isset($_POST['AddToShoppingCart'])) {
    AddToSession($_POST["ticketID"]);
    header('Location: ../View/ShoppingCart.php');
}



//Adds The item to a session
function AddToSession($ticketID)
{

    $ticketDAL = new TicketDAL();
    $tickets =(array)$ticketDAL->GetTicketByID($ticketID);

    //If there isn't a session, make one and add to it
    if (!isset($_SESSION['Products']) || empty($_SESSION['Products'])) {
        foreach ($tickets as $ticket) {
            $_SESSION['products'] = array();
            $cart = array('ticketID' => $ticketID, 'airline' => $ticket->getAirline(),
                'flightFrom' => $ticket->getFlightFrom(), 'flightTo' => $ticket->getFlightTo(), 'Price' => $ticket->getPrice(), 'image' => $ticket->getImage(), 'timeArrival' => $ticket->getTimeArrival(), 'timeDeparture' => $ticket->getTimeDeparture());

        }

    } //Use existing session to add to
    else {

        foreach ($tickets as $ticket) {
            $_SESSION['products'] = array();
            $cart = array('ticketID' => $ticketID, 'airline' => $ticket->getAirline(),
                'flightFrom' => $ticket->getFlightFrom(), 'flightTo' => $ticket->getFlightTo(), 'Price' => $ticket->getPrice(), 'image' => $ticket->getImage(), 'timeArrival' => $ticket->getTimeArrival(), 'timeDeparture' => $ticket->getTimeDeparture());

        }
    }

    $_SESSION['Products'][ticketID] = $cart;



}


?>
