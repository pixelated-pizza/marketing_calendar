<?php

namespace Database\Seeders;

use Database\Seeders\CampaignTypeSeeder;
use Database\Seeders\ChannelSeeder;
use Database\Seeders\EventSeeder;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CampaignTypeSeeder::class,
            ChannelSeeder::class,
            EventSeeder::class,
        ]);
    }
}
