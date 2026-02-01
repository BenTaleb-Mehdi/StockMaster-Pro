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

        $admin = User::firstOrCreate([
            'email' => 'admin@stock.com',
        ], [
            'name' => 'Admin StockMaster',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        $this->call([

            CsvDataSeeder::class,
            RolesSeeder::class
        ]);

        $admin->assignRole('admin');
    }
}
