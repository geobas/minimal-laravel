<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;
use App\Reservation as Reservation;
use App\Events\ReservationEvents;
use App\BookRoom;
use Illuminate\Contracts\Events\Dispatcher as Event;

class ReservationsController extends Controller
{
    public function __construct(Reservation $reservation)
    {
        $this->reservations = $reservation->all();
    }

	//
    public function bookRoom(Event $event, $client_id, $room_id, $date_in, $date_out, Client $client, Room $room, Reservation $reservation)
    {
    	$client = $client->find($client_id);
    	$room = $room->find($room_id);
    	$reservation->date_in = $date_in;
    	$reservation->date_out = $date_out;

    	$reservation->room()->associate($room);
    	$reservation->client()->associate($client);

    	if ( $room->isRoomBooked($room_id, $date_in, $date_out) )
    		abort(405, 'Trying to book an already booked room');

    	$reservation->save();

        // fire the event that a room has been booked
        $event->fire(ReservationEvents::BOOKED, new BookRoom($reservation));

    	return redirect()->route('clients');

        // return view('reservation/bookRoom');
    }

    public function index()
    {
        $data = [];
        $data['reservations'] = $this->reservations;

        return view('reservation/index', $data);
    }
}
