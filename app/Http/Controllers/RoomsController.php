<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;
use App\Traits\{RoomDataHandler, Logger};
use Illuminate\Contracts\View\Factory as View;

class RoomsController extends Controller
{
    use RoomDataHandler,
    	Logger;

    /**
     * Render a form for adding a new booking for a client.
     *
     * @param  string  					  $client_id
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Client  			  $client
     * @param  \App\Room    			  $room
     * @param  Illuminate\View\Factory    $view
     * @throws \Exception|\Error
     * @return \Illuminate\View\View
     */
    public function checkAvailableRooms(string $client_id, Request $request, Client $client, Room $room, View $view)
    {
        try {
            return $view->make('room/checkAvailableRooms', $this->handleData($client_id, $request, $client, $room));
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }
}
