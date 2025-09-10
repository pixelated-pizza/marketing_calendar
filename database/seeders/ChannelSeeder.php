<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channelTypes = [
            [
                'channel_name' => 'Mytopia',
                'campaign_type_id' => 1
            ],
            [
                'channel_name' => 'Edisons',
                'campaign_type_id' => 1
            ],
            [
                'channel_name' => 'Hot Deals',
                'campaign_type_id' => 1
            ],
            [
                'channel_name' => 'Additional Campaigns',
                'campaign_type_id' => 1
            ],
            [
                'channel_name' => 'Adhoc Promos / Coupons',
                'campaign_type_id' => 1
            ],
            [
                'channel_name' => 'External Events',
                'campaign_type_id' => 1
            ]

        ];

        foreach ($channelTypes as $type) {
            Channel::create($type);
        }
    }
}
