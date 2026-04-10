<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['new', 'in_process', 'processed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
