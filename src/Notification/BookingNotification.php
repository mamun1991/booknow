<?php
// src/Notification/BookingNotification.php
namespace App\Notification;

use App\Entity\Bookindorder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingNotification
{
    public function sendBookingNotification(Bookindorder $booking)
    {
        // Your notification logic here
        // This is a placeholder, replace it with your actual notification implementation
        // For example, send an email, push notification, etc.
        // You can access booking details like $booking->getId(), $booking->getHotel(), etc.
        return new JsonResponse(['status' => 'Success', 'message' => 'Your Booking Confirmed event'], Response::HTTP_OK);
    }
}
