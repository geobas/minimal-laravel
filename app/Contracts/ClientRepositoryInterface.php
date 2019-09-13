<?php

namespace App\Contracts;

interface ClientRepositoryInterface
{
    /**
     * Get all instances.
     *
     * @return Collection array of objects
     */
    public function all();

    /**
     * Find the model with the given id.
     *
     * @param  int $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return \App\Client
     */
    public function find(int $id);

    /**
     * Create a new record in the database.
     *
     * @param  array  $attributes
     * @return \App\Client
     */
    public function create(array $attributes);

    /**
     * Update record in the database.
     *
     * @param  int    $id
     * @param  array  $attributes
     * @return bool
     */
    public function update(int $id, array $attributes);

    /**
     * Remove record from the database.
     *
     * @param  int $id
     * @return int
     */
    public function delete(int $id);
}