<?php

namespace App\Http\Controllers;

use App\{Title, Reservation};
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository as Client;
use Illuminate\Contracts\View\Factory as View;
use App\Traits\{ClientDataHandler, Logger};

class ClientsController extends Controller
{
    use ClientDataHandler,
        Logger;

    /**
     * Repository instance.
     *
     * @var \App\Repositories\ClientRepository
     */
    protected $client;

    /**
     * Instance of View.
     *
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * Initialize controller.
     *
     * @param \Illuminate\View\Factory            $view
     * @param \App\Title                          $titles
     * @param \App\Repositories\ClientRepository  $client
     */
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

    /**
     * List all clients.
     *
     * @throws \Exception|\Error
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $clients = $this->client->all();

            return $this->view->make('client/index', compact('clients'));
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Render a form for adding a new client.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \Illuminate\View\Factory   $view
     * @throws \Exception|\Error
     * @return \Illuminate\View\View
     */
    public function new(Request $request, View $view)
    {
        try {
            return $this->view->make('client/form', $this->newClientData($request));
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Save a new client.
     *
     * @param  \Illuminate\View\Factory        $view
     * @param  \App\Http\Requests\UserRequest  $request
     * @throws \Exception|\Error
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(View $view, UserRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                $this->client->create($request->all());

                return redirect('clients');
            }
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Render a form for editing a client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\View\Factory  $view
     * @param  int                       $id
     * @throws \Exception|\Error
     * @return \Illuminate\View\View
     */
    public function show(Request $request, View $view, int $id)
    {
        try {
            $data = $this->showClientData($id, $request);

            return $this->view->make('client/form', $data);
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Update a client.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \Illuminate\View\Factory        $view
     * @param  int                             $id
     * @throws \Exception|\Error
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(UserRequest $request, View $view, int $id)
    {
        try {
            if ($request->isMethod('post')) {
                $this->client->update($id, $request->all());

                return redirect('clients');
            }
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    /**
     * Delete a client with all his reservations.
     *
     * @param  int              $id
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(int $id, Reservation $reservation)
    {
        try {
            $this->deleteClient($id, $reservation);

            return redirect('clients');
        } catch (\Throwable $t) {
            $this->LogError($t);
        }
    }

    public function export(View $view)
    {
        $data = $this->exportExcel();

        return $this->view->make('client/export', $data);
    }
}
