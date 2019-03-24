<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Reservation;

trait ClientDataHandler
{
    private function newClientData(Request $request)
    {
        $new_client_data = [];
        $new_client_data = array_fill_keys($this->client->getFillable(), null);
        $new_client_data['name'] = $request->input('name', 'geo');
        $new_client_data['client_title'] = '';
        unset($new_client_data['title']);

        $new_client_data['titles'] = $this->titles;
        $new_client_data['modify'] = 0;

        return $new_client_data;
    }

    private function showClientData($id, Request $request)
    {
        $data = [];
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        $client_data = $this->client->find($id);

        if ( !empty($client_data) ) {
            $data = array_merge($data, $client_data->toArray());
            $data['client_id'] = $data['id'];
            unset($data['id']);
            $data['client_title'] = $data['title'];
            unset($data['title']);

            $request->session()->put('last_updated', $client_data->name . ' ' . $client_data->last_name);
        } else {
            return redirect('clients');
        }

        return $data;
    }

    private function deleteClient($id, Reservation $reservation)
    {
        $reservations = $this->client->find($id)->reservations;
        foreach( $reservations as $reservation ) {
            $reservation->destroy($reservation->id);
        }
        $this->client->delete($id);
    }

    private function exportExcel()
    {
        $data = [];
        $data['clients'] = $this->client->all();
        header('Content-Disposition: attachment;filename=export.xls');

        return $data;
    }
}