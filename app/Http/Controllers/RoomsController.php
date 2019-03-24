<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;
use App\Traits\RoomDataHandler;

class RoomsController extends Controller
{
    use RoomDataHandler;

    public function checkAvailableRooms($client_id, Request $request, Client $client, Room $room)
    {
    	return view('room/checkAvailableRooms', $this->handleData($client_id, $request, $client, $room));
    }
}
