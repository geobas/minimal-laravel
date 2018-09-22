<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;
use App\Reservation as Reservation;
use App\Http\Requests\UserRequest;

class ClientsController extends Controller
{
    public function __construct(Title $titles, Client $client)
    {
        $this->titles = $titles->all();
        $this->client = $client;
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = [];
        $data['clients'] = $this->client->all();

        return view('client/index', $data);
    }

    public function new(Request $request)
    {
        $data = [];
        $data = array_fill_keys($this->client->getFillable(), null);
        $data['name'] = $request->input('name', 'geo');
        $data['client_title'] = '';
        unset($data['title']);

        $data['titles'] = $this->titles;
        $data['modify'] = 0;

        return view('client/form', $data);
    }

    public function create(UserRequest $request, Client $client)
    {
        if( $request->isMethod('post') )
        {
            $client->create($request->all());
            return redirect('clients');
        }

        return view('client/create', $data);
    }

    public function show($id, Request $request)
    {
        $data = [];
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        $client_data = $this->client->findOrFail($id);

        if ($client_data)
        {
            $data = array_merge($data, $client_data->toArray());
            $data['client_id'] = $data['id'];
            unset($data['id']);
            $data['client_title'] = $data['title'];
            unset($data['title']);

            $request->session()->put('last_updated', $client_data->name . ' ' . $client_data->last_name);
        }
        else
        {
            return redirect('clients');
        }

        return view('client/form', $data);
    }

    public function edit($id, UserRequest $request)
    {
        if( $request->isMethod('post') )
        {
            $client = $this->client->findOrFail($id);
            $client->update($request->all());

            return redirect('clients');
        }

        return view('client/edit');
    }

    public function delete($id)
    {
        $reservations = $this->client->find($id)->reservations;
        foreach($reservations as $reservation)
        {
            Reservation::destroy($reservation->id);
        }
        Client::destroy($id);

        $data = [];
        $data['clients'] = $this->client->all();

        return view('client/index', $data);
    }

    public function export()
    {
        $data = [];
        $data['clients'] = $this->client->all();
        header('Content-Disposition: attachment;filename=export.xls');

        return view('client/export', $data);
    }
}
