<?php
// src/Service/NotificationHandler.php
namespace App\Service;

use Psr\Log\LoggerInterface;

class NotificationHandler
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendNotification($booking)
    {
        // Replace this with your actual notification logic
        try {
            // Example: Send an email
            $this->sendEmailNotification($booking);

            $this->logger->info('Notification sent successfully.');
        } catch (\Exception $e) {
            $this->logger->error('Failed to send notification: ' . $e->getMessage());
            throw $e; // Rethrow the exception if necessary
        }
    }

    private function sendEmailNotification($booking)
    {
        // Implement your email notification logic here
        // Example: Use Symfony Mailer or any other library to send emails
        // $mailer->send(...);
    }
}
