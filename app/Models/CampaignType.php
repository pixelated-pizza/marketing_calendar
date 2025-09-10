<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignType extends Model
{
    public $timestamps = false;

    protected $primaryKey = "campaign_type_id";

    protected $fillable = [
        'campaign_type_name',
    ];
    
}
