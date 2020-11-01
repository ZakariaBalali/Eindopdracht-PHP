<?php
require_once dirname(__FILE__) . '/../DAL/TicketDAL.php';

class TicketLogic
{
    private $ticketDAL;

    function __construct()
    {
        $this->ticketDAL = new TicketDAL();
    }

    //gets getAllTickets function from the DAL layer
    function GetAllTickets()
    {
        return $this->ticketDAL->GetAllTickets();
    }
}