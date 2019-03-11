<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ReservationEvents;
use App\BookRoom;
use Psr\Log\LoggerInterface as Logger;

class ReservationEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param OrderEvent $reservationEvent
     */
    public function onRoomBooked(BookRoom $bookRoom)
    {
        // Get reservation event
        $reservation = $bookRoom->getReservation();

        // Log reservation
        $this->logger->info('An reservation was made: ' . $reservation);
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events) {
        $events->listen(
            ReservationEvents::BOOKED,
            'App\Listeners\ReservationEventSubscriber@onRoomBooked'
        );
    }
}
