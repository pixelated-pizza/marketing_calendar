<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        return Channel::select([
            'channel_id as key', 
            'channel_name as label', 
            'campaign_type_id'])->get();
    }
}
