<?php

namespace Database\Factories;

use App\DTOs\ClientDTO;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var Faker\Factory */
        $_faker = Faker::create('pt_BR');

        /** @var int */
        $ddd = $_faker->numberBetween(11, 99);

        return [
            'name'       => fake()->name(),
            'email'      => fake()->unique()->safeEmail(),
            'cpf'        => ClientDTO::unmask($_faker->cpf),
            'phone'      => $_faker->numerify("{$ddd}9########"),
            'cep'        => ClientDTO::unmask($_faker->postcode),
            'address'    => $_faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
