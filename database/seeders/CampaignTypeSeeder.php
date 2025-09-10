<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CampaignType;

class CampaignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaignTypes = [
            [
                'campaign_type_name' => 'Campaigns'
            ],
            [
                'campaign_type_name' => 'Website Mytopia'
            ],
            [
                'campaign_type_name' => 'Website Edisons'
            ],
            [
                'campaign_type_name' => 'Marketplaces (Campaigns)'
            ]
        ];

        foreach ($campaignTypes as $type) {
            CampaignType::create($type);
        }
    }
}
