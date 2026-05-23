<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DriverSeeder::class,
        ]);

        if (app()->isLocal()) {
            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'admin',
                    'password' => Hash::make('admin'),
                    'is_admin' => true,
                ]
            );
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
