<?php

namespace App\Repositories;

use App\Client;

class ClientRepository
{
	/**
	 * Model instance.
	 *
	 * @var Client
	 */
	protected $client;

	/**
	 * Bind model to repository.
	 *
	 * @param Client $client
	 */
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Get all instances.
	 *
	 * @return Collection array of objects
	 */
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

    /**
     * Find the model with the given id.
     *
     * @param  int $id
     * @return App\Client
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find($id)
    {
    	return $this->client->findOrFail($id);
    }

    /**
     * Create a new record in the database.
     *
     * @param  array  $attributes
     * @return App\Client
     */
    public function create(array $attributes)
    {
    	return $this->client->create($attributes);
    }

    /**
     * Update record in the database.
     *
     * @param  int $id
     * @param  array  $attributes
     * @return bool
     */
    public function update($id, array $attributes)
    {
       return $this->find($id)->update($attributes);
    }

    /**
     * Remove record from the database.
     *
     * @param  int $id
     * @return int
     */
    public function delete($id)
    {
    	return $this->client->destroy($id);
    }
}