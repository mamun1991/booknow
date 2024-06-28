<?php
// src/EventSubscriber/BookingOrderInsertedSubscriber.php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\BookingOrderInsertedEvent;
use Psr\Log\LoggerInterface; // Import the LoggerInterface
use App\Notification\BookingNotification; // Import your notification service

class BookingOrderInsertedSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $notificationService;

    public function __construct(LoggerInterface $logger, BookingNotification $notificationService)
    {
        $this->logger = $logger;
        $this->notificationService = $notificationService;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BookingOrderInsertedEvent::class => 'onBookingOrderInserted',
        ];
    }

    public function onBookingOrderInserted(BookingOrderInsertedEvent $event): void
    {
        try {
            $booking = $event->getBookingOrder();

            // Your custom logic here
            // For example, log the event
            $this->logger->info('Booking order inserted: ' . $booking->getId());

            // Send a notification
            $this->notificationService->sendBookingNotification($booking);

            // You can perform other actions like updating statistics, etc.

        } catch (\Exception $e) {
            // Handle exceptions if needed
            // You might want to log the exception or take appropriate action
            $this->logger->error('Error handling BookingOrderInsertedEvent: ' . $e->getMessage());
        }
    }
}
