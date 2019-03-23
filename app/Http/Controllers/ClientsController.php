<?php

namespace App\Http\Controllers;

use App\{Title, Reservation};
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository as Client;
use Illuminate\Contracts\View\Factory as View;
use App\Traits\ClientDataHandler;

class ClientsController extends Controller
{
    use ClientDataHandler;

    protected $client;

    protected $view;

    public function __construct(View $view, Title $titles, Client $client)
    {
        $this->titles = $titles->all();
        $this->client = $client;
        $this->view = $view;
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $clients = $this->client->all();

        return $this->view->make('client/index', compact('clients'));
    }

    public function new(Request $request, View $view)
    {
        return $this->view->make('client/form', $this->newClientData($request));
    }

    public function create(View $view, UserRequest $request)
    {
        if ( $request->isMethod('post') ) {
            $this->client->create($request->all());

            return redirect('clients');
        }
    }

    public function show(Request $request, View $view, $id)
    {
        $data = $this->showClientData($id, $request);

        return $this->view->make('client/form', $data);
    }

    public function edit(UserRequest $request, View $view, $id)
    {
        if ( $request->isMethod('post') ) {
            $this->client->update($id, $request->all());

            return redirect('clients');
        }
    }

    public function delete($id, Reservation $reservation)
    {
        $this->deleteClient($id, $reservation);

        return redirect('clients');
    }

    public function export(View $view)
    {
        $data = $this->exportExcel();

        return $this->view->make('client/export', $data);
    }
}
