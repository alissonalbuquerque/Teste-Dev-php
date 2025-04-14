<?php

namespace Tests\Feature;

use App\DTOs\ClientDTO;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientApiTest extends TestCase
{   
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    public function test_can_search_clients() {

        /** @var Collection */
        $clients = Client::factory()->count(1)->create();

        /** @var Client */
        $client = $clients->first();

        /** @var string  */
        $per_page = 1;

        $response = $this->getJson("/api/v1/clients?name={$client->name}&cpf={$client->cpf}&cep={$client->cep}&per_page={$per_page}");

        $response->assertStatus(Response::HTTP_OK)
                    ->assertJsonFragment(['id' => $client->id]);
    }

    public function test_can_create_client() {

        /** @var Faker\Factory */
        $_faker = Faker::create('pt_BR');

        /** @var int */
        $ddd = $_faker->numberBetween(11, 99);

        /** @var string */
        $cep = "80740-000";

        $data = [
            'name'  => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'cpf'   => $_faker->cpf,
            'phone' => $_faker->numerify("({$ddd}) 9####-####"),
            'cep'   => $cep
        ];

        $response = $this->postJson('/api/v1/clients', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                    ->assertJsonFragment(['email' => $data['email']]);

        $this->assertDatabaseHas('clients', ['email' => $data['email']]);
    }

    public function test_can_show_client() {

        /** @var Collection */
        $clients = Client::factory()->count(1)->create();

        /** @var Client */
        $client = $clients->first();

        $response = $this->getJson("/api/v1/clients/{$client->id}");
        
        $response->assertStatus(Response::HTTP_OK)
                    ->assertJsonFragment(['id' => $client->id]);
    }

    public function test_can_update_client_name() {

        /** @var Faker\Factory */
        $_faker = Faker::create('pt_BR');

        /** @var int */
        $ddd = $_faker->numberBetween(11, 99);

        /** @var string */
        $cep = "80740-000";

        $data = [
            'name'  => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'cpf'   => $_faker->cpf,
            'phone' => $_faker->numerify("({$ddd}) 9####-####"),
            'cep'   => $cep
        ];

        /** @var Collection */
        $clients = Client::factory()->count(1)->create();

        /** @var Client */
        $client = $clients->first();

        $response = $this->putJson("/api/v1/clients/{$client->id}", $data);

        $response->assertStatus(Response::HTTP_OK)
                    ->assertJsonFragment(['cep' => $data['cep']]);

        $this->assertDatabaseHas('clients', [
            'cep' => ClientDTO::unmask($data['cep'])
        ]);
    }

    public function test_delete_client() {

        /** @var Collection */
        $clients = Client::factory()->count(1)->create();

        /** @var Client */
        $client = $clients->first();

        $response = $this->delete("/api/v1/clients/{$client->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
