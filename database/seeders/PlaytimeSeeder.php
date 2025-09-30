<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Playtime;

class PlaytimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Playtime::factory()
        ->count(30)
        ->create();
    }
    
}
