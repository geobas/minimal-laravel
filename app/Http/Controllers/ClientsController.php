<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;

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
       // $obj = new \stdClass;
       // $obj->id = 1;
       // $obj->title = 'mr';
       // $obj->name = 'john';
       // $obj->last_name = 'doe';
       // $obj->email = 'john@domain.com';
       // $data['clients'][] = $obj;

       // $obj = new \stdClass;
       // $obj->id = 2;
       // $obj->title = 'ms';
       // $obj->name = 'jane';
       // $obj->last_name = 'doe';
       // $obj->email = 'jane@another-domain.com';
       // $data['clients'][] = $obj;

       $data = [];
       $data['clients'] = $this->client->all();

       return view('client/index', $data);
    }

    public function new(Request $request)
    {
        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name') ? $request->input('name') : 'geo';
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');

        $data['titles'] = $this->titles;
        $data['modify'] = 0;

        return view('client/form', $data);
    }

    public function create(Request $request, Client $client)
    {
        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');

        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'last_name' => 'required|min:5',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
                ]
            );

            $client->insert($data);

            return redirect('clients');
        }

        return view('client/create', $data);
    }

    public function show($id)
    {
        $data = [];
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        $client_data = $this->client->find($id);
        $data['client_id'] = $id;
        $data['title'] = $client_data->title;
        $data['name'] = $client_data->name;
        $data['last_name'] = $client_data->last_name;
        $data['address'] = $client_data->address;
        $data['zip_code'] = $client_data->zip_code;
        $data['city'] = $client_data->city;
        $data['state'] = $client_data->state;
        $data['email'] = $client_data->email;

        return view('client/form', $data);
    }

    public function edit($id, Request $request)
    {
        $data = [];

        $data['title'] = $request->input('title');
        $data['name'] = $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] = $request->input('address');
        $data['zip_code'] = $request->input('zip_code');
        $data['city'] = $request->input('city');
        $data['state'] = $request->input('state');
        $data['email'] = $request->input('email');

        if( $request->isMethod('post') )
        {
            //dd($data);
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'last_name' => 'required|min:5',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
                ]
            );

            $client_data = $this->client->find($id);

            $client_data->title = $request->input('title');
            $client_data->name = $request->input('name');
            $client_data->last_name = $request->input('last_name');
            $client_data->address = $request->input('address');
            $client_data->zip_code = $request->input('zip_code');
            $client_data->city = $request->input('city');
            $client_data->state = $request->input('state');
            $client_data->email = $request->input('email');

            $client_data->save();

            return redirect('clients');
        }

        return view('client/edit');
    }
}
