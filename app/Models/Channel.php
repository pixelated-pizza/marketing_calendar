<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $timestamps = false;

    protected $primaryKey = "channel_id";

    protected $fillable = [
        'channel_name',
    ];

    public function campaignType()
    {
        return $this->belongsTo(CampaignType::class, 'campaign_type_id');
    }
}
