<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CampaignType;

class CampaignTypeController extends Controller
{
    public function index()
    {
        return CampaignType::all(['id as key', 'type_name as label']);
    }
}
