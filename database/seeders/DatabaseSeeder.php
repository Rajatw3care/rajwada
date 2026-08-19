<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'rajatsharmaba1995@gmail.com'],
            ['name' => 'Rajwada Admin', 'password' => bcrypt('Rajwada@2026'), 'email_verified_at' => now()]
        );

        $this->call(RajwadaContentSeeder::class);
    }
}
