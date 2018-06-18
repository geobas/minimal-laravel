<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request, Client $client, Room $room)
    {
    	$dateFrom = $request->input('dateFrom');
    	$dateTo = $request->input('dateTo');

    	// $client = new Client();
    	// $room = new Room();

    	$data = [];
    	$data['dateFrom'] = $dateFrom;
    	$data['dateTo'] = $dateTo;
    	$data['rooms'] = $room->getAvailableRooms($dateFrom, $dateTo);
    	$data['client'] = $client->find($client_id);

    	return view('room/checkAvailableRooms', $data);
    }
}
