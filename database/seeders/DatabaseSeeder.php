<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Crear órdenes
        Order::factory(5)->create();
    }
}
