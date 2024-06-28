<?php
// src/Event/BookingOrderInsertedEvent.php

namespace App\Event;

use App\Entity\Bookindorder;
use Symfony\Contracts\EventDispatcher\Event;

class BookingOrderInsertedEvent extends Event
{
    private Bookindorder $bookingOrder;

    public function __construct(Bookindorder $bookingOrder)
    {
        $this->bookingOrder = $bookingOrder;
    }

    public function getBookingOrder(): Bookindorder
    {
        return $this->bookingOrder;
    }
}
