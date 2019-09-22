<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Client;
use App\Repositories\ClientRepository;
use App\Exceptions\{ClientNotFoundException, CreateClientException, UpdateClientException};

class ClientTest extends TestCase
{
    use WithFaker,
        RefreshDatabase;

    /*
    protected function setUp()
    {
        parent::setUp();
    }
    */

    public function testCreateClient()
    {
        $data = [
            'title' => $this->faker->title,
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->streetAddress,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'email' => $this->faker->email,
        ];

        $clientRepo = new ClientRepository(new Client);
        $client = $clientRepo->create($data);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals($data['title'], $client->title);
        $this->assertEquals($data['address'], $client->address);
        $this->assertEquals($data['state'], $client->state);

        $this->expectException(CreateClientException::class);

        $clientRepo = new ClientRepository(new Client);
        $client = $clientRepo->create([]);
    }

    public function testFindClient()
    {
        $client = factory(Client::class)->create();
        $clientRepo = new ClientRepository($client);

        $find = $clientRepo->find(2);

        $this->assertEquals($client->name, $find->name);
        $this->assertEquals($client->last_name, $find->last_name);
        $this->assertEquals($client->city, $find->city);

        $this->expectException(ClientNotFoundException::class);

        $find = $clientRepo->find(666);
    }

    public function testUpdateClient()
    {
        $client = factory(Client::class)->create();

        $data = [
            'name' => $this->faker->firstName,
            'address' => $this->faker->streetAddress,
            'zip_code' => $this->faker->postcode,
            'email' => $this->faker->email,
        ];

        $clientRepo = new ClientRepository($client);

        $update = $clientRepo->update($client->id, $data);

        $client = $clientRepo->find($client->id);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $client->name);
        $this->assertEquals($data['zip_code'], $client->zip_code);
        $this->assertEquals($data['email'], $client->email);

        $this->expectException(UpdateClientException::class);

        $update = $clientRepo->update($client->id, ['title' => null]);
    }

    public function testDeleteClient()
    {
        $client = factory(Client::class)->create();

        $clientRepo = new ClientRepository($client);
        $delete = $clientRepo->delete($client->id);

        $this->assertEquals(1, $delete);

        $delete = $clientRepo->delete(666);
        $this->assertNotEquals(1, $delete);
    }
}