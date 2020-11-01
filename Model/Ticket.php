<?php

class Ticket
{
    public $ticketID;
    private $airline;
    private $flightFrom;
    private $flightTo;
    private $timeDeparture;
    private $timeArrival;
    private $price;
    private $image;


    function __construct($ticketID, $airline, $flightFrom, $flightTo, $timeDeparture, $timeArrival, $price, $image)
    {
        $this->ticketID = $ticketID;
        $this->airline = $airline;
        $this->flightFrom = $flightFrom;
        $this->flightTo = $flightTo;
        $this->timeDeparture = $timeDeparture;
        $this->timeArrival = $timeArrival;
        $this->price = $price;
        $this->image = $image;

    }

    public function getTicketID()
    {
        return $this->ticketID;
    }

    public function setTicketID($ticketID)
    {
        $this->ticketID = $ticketID;
    }

    public function getAirline()
    {
        return $this->airline;
    }

    public function setAirline($airline)
    {
        $this->airline = $airline;
    }

    public function getFlightFrom()
    {
        return $this->flightFrom;
    }

    public function setFlightFrom($flightFrom)
    {
        $this->flightFrom = $flightFrom;
    }

    public function getFlightTo()
    {
        return $this->flightTo;
    }

    public function setFlightTo($flightTo)
    {
        $this->flightTo = $flightTo;
    }

    public function getTimeDeparture()
    {
        return $this->timeDeparture;
    }

    public function setTimeDeparture($timeDeparture)
    {
        $this->timeDeparture = $timeDeparture;
    }

    public function getTimeArrival()
    {
        return $this->timeArrival;
    }

    public function setTimeArrival($timeArrival)
    {
        $this->timeArrival = $timeArrival;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }




}
