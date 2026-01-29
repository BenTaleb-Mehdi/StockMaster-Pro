<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin StockMaster',
            'email' => 'admin@stock.com',
            'password' => Hash::make('password123'), // Password bach t-login
        ]);

        $this->call([
            CsvDataSeeder::class,
            RolesSeeder::class
        ]);

        $admin->assignRole('admin');
    }
}
