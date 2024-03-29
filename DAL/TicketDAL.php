<?php
require_once dirname(__FILE__) . '/../Model/Ticket.php';
require_once dirname(__FILE__) . '/DbConnection.php';

class TicketDAL
{
    private $connection;
    private $instance;

    //makes the connection to the database
    function __construct()
    {
        $this->instance = DbConnection::getInstance();
        $this->connection = $this->instance->getConnection();
    }


    //Gets ticket info from db and puts values into array
    function GetAllTickets()
    {
        $sql = "SELECT * from tickets";

        $tickets = [];
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $ticketID = $row["ticketID"];
                $airline = $row['airline'];
                $flightFrom = $row['flightFrom'];
                $flightTo = $row["flightTo"];
                $timeDeparture = $row['timeDeparture'];
                $timeArrival = $row['timeArrival'];
                $price = $row['price'];
                $image = $row['image'];

                $ticket = new Ticket($ticketID, $airline, $flightFrom, $flightTo, $timeDeparture, $timeArrival, $price, $image);
                $tickets[] = $ticket;
            }
            return $tickets;
        } else {
            echo 'no tickets found';
        }
    }

    function GetTicketByID($ticketID)
    {
        //prepared statement

        $stmt = $this->connection->prepare("SELECT ticketID, airline, flightFrom, flightTo, timeDeparture, timeArrival, price, image FROM `tickets` WHERE ticketID = ?");
        $stmt->bind_param("i", $ticketID);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {

            $ticketID = $row["ticketID"];
            $airline = $row['airline'];
            $flightFrom = $row['flightFrom'];
            $flightTo = $row["flightTo"];
            $timeDeparture = $row['timeDeparture'];
            $timeArrival = $row['timeArrival'];
            $price = $row['price'];
            $image = $row['image'];

            $ticket = new Ticket($ticketID, $airline, $flightFrom, $flightTo, $timeDeparture, $timeArrival, $price, $image);
            $tickets[] = $ticket;
        }
        return $tickets;
    }
}

?>