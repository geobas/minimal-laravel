<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;
use App\Reservation as Reservation;
use App\Events\ReservationEvents;
use App\BookRoom;
use Illuminate\Contracts\Events\Dispatcher as Event;
use Illuminate\Contracts\View\Factory as View;
use App\Traits\Logger;

class ReservationsController extends Controller
{
    use Logger;

    /**
     * Instance of Reservation.
     *
     * @var \App\Reservation
     */
    protected $reservations;

    /**
     * Initialize controller.
     *
     * @param Reservation $reservation
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservations = $reservation->all();
    }

    /**
     * List all reservations.
     *
     * @param  Illuminate\View\Factory  $view
     * @return \Illuminate\View\View
     */
    public function index(View $view)
    {
        $data = [];
        $data['reservations'] = $this->reservations;

        return $view->make('reservation/index', $data);
    }

    /**
     * Book a room for a specific duration.
     *
     * @param  \Illuminate\Events\Dispatcher  $event
     * @param  \Illuminate\Http\Request       $request
     * @param  \App\Client                    $client
     * @param  \App\Room                      $room
     * @param  \App\Reservation               $reservation
     * @throws \Exception|\Error
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bookRoom(Event $event, Request $request, Client $client, Room $room, Reservation $reservation)
    {
        try {
            $reservation = $this->setUpReservation($request, $client, $room, $reservation);

            $reservation->save();

            // fire the event that a room has been booked
            $event->fire(ReservationEvents::BOOKED, new BookRoom($reservation));

            return redirect()->route('clients');

            // return view('reservation/bookRoom');
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Set up a reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client               $client
     * @param  \App\Room                 $room
     * @param  \App\Reservation          $reservation
     * @throws \Exception
     * @return \App\Reservation
     */
    private function setUpReservation(Request $request, Client $client, Room $room, Reservation $reservation)
    {
        $client = $client->findOrFail($request->client_id);

        $room = $room->findOrFail($request->room_id);

        $reservation->date_in = $request->date_in;

        $reservation->date_out = $request->date_out;

        $reservation->room()->associate($room);

        $reservation->client()->associate($client);

        if ( $room->isRoomBooked($request->room_id, $request->date_in, $request->date_out) )
            abort(405, 'Trying to book an already booked room');

        return $reservation;
    }
}
