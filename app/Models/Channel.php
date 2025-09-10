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
}
