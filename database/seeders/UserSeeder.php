<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Game;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User::factory()
        ->count(50)
        ->hasPlaytimes(30)
        ->hasAttached(Game::factory()->count(3))
        ->create();
    }
}
