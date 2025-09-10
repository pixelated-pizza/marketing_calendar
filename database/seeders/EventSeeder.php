<?php

namespace Database\Seeders;

use App\Models\CalendarEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;   
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventSample = [
            [
                'event_id' => 1,
                'channel_id' => 1,
                'campaign_type_id' => 1,
                'event_name' => 'Summer Sale',
                'start_date' => '2025-08-26',
                'end_date' => '2025-09-09',
            ],
            [
                'event_id' => 2,
                'channel_id' => 2,
                'campaign_type_id' => 1,
                'event_name' => 'Back to School',
                'start_date' => '2025-09-09',
                'end_date' => '2025-09-22',
            ]
        ];

        foreach ($eventSample as $type) {
            CalendarEvent::create($type);
        }
    }
}
