<?php

namespace App\Repositories;

use App\Contracts\ClientRepositoryInterface;
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

    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
    	return $this->client->getFillable();
    }

    public function find(int $id)
    {
    	return $this->client->findOrFail($id);
    }

    public function create(array $attributes)
    {
    	return $this->client->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
       return $this->find($id)->update($attributes);
    }

    public function delete(int $id)
    {
    	return $this->client->destroy($id);
    }
}