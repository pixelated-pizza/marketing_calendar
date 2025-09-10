<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CampaignType;

class CampaignTypeController extends Controller
{
    public function index()
    {
        return CampaignType::select(['campaign_type_id as key', 'campaign_type_name as label'])->get();
    }
}
