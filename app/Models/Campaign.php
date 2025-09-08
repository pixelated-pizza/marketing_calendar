<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $timestamps = false;

    protected $primaryKey = "campaign_id";

    protected $fillable = [
        'channel_id',
        'campaign_type_id',
        'campaign_name',
        'start_date',
        'end_date',
    ];
}
