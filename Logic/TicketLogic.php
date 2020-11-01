<?php
require_once dirname(__FILE__) . '/../DAL/TicketDAL.php';

class TicketLogic
{
    private $ticketDAL;

    function __construct()
    {
        $this->ticketDAL = new TicketDAL();
    }

    function CloseConnection()
    {
        $this->ticketDAL->dbCloseConnection();
    }

    function GetAllTickets()
    {
        return $this->ticketDAL->GetAllTickets();
    }
}