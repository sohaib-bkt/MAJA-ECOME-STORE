<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'sohaib',
            'email' => 'sohaib@gmail.com',
            'age' => 20,
            'role' => 'admin',
            'password' => bcrypt('1'),
        ]);
        \App\Models\User::factory()->create([
            'name' => 'yousef',
            'email' => 'yousef@gmail.com',
            'age' => 20,
            'role' => 'client',
            'password' => bcrypt('1'),
        ]);
        $this->call(ProductSeeder::class);
    }
}
