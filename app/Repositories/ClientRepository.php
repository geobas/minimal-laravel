<?php

namespace App\Repositories;

use App\Exceptions\{ClientNotFoundException, CreateClientException, UpdateClientException, DeleteClientException};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Contracts\ClientRepositoryInterface;
use Illuminate\Database\QueryException;
use App\Client;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * Model instance.
     *
     * @var \App\Client
     */
    protected $client;

    /**
     * Bind model to repository.
     *
     * @param \App\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return $this->client->all();
    }

    public function find(int $id)
    {
        try {
            return $this->client->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ClientNotFoundException($e);
        }
    }

    public function create(array $attributes)
    {
        try {
            return $this->client->create($attributes);
        } catch (QueryException $e) {
            throw new CreateClientException($e);
        }
    }

    public function update(int $id, array $attributes)
    {
        try {
            return $this->find($id)->update($attributes);
        } catch (QueryException $e) {
            throw new UpdateClientException($e);
        }
    }

    public function delete(int $id)
    {
        try {
            return $this->client->destroy($id);
        } catch (QueryException $e) {
            throw new DeleteClientException($e);
        }
    }

    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->client->getFillable();
    }
}