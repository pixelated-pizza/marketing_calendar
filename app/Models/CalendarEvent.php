<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    public $timestamps = false;

    protected $primaryKey = "event_id";

    protected $fillable = [
        'campaign_type_id',
        'channel_id',
        'event_name',
        'start_date',
        'end_date',
    ];

     public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'channel_id');
    }

    public function campaignType()
    {
        return $this->belongsTo(CampaignType::class, 'campaign_type_id', 'campaign_type_id');
    }
}
