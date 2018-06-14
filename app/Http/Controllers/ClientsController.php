<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;

class ClientsController extends Controller
{
    public function __construct(Title $titles)
    {
        $this->titles = $titles->all();
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
       $obj = new \stdClass;
       $obj->id = 1;
       $obj->title = 'mr';
       $obj->name = 'john';
       $obj->last_name = 'doe';
       $obj->email = 'john@domain.com';
       $data['clients'][] = $obj;

       $obj = new \stdClass;
       $obj->id = 2;
       $obj->title = 'ms';
       $obj->name = 'jane';
       $obj->last_name = 'doe';
       $obj->email = 'jane@another-domain.com';
       $data['clients'][] = $obj;

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

    public function create(Request $request)
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

            return redirect('clients');
        }

        return view('client/create', $data);
    }

    public function show($id)
    {
        $data = [];
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        return view('client/form', $data);
    }

    public function edit($id)
    {
        return view('client/edit');
    }
}
