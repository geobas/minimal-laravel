<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\{Client, Room};

trait RoomDataHandler
{
    private function handleData($client_id, Request $request, Client $client, Room $room)
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

        return $data;
    }
}