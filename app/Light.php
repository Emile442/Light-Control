<?php

namespace App;

use App\Zigbee\DeconzApi;
use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $fillable = ["name", "group_id", "networkId"];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function getStateAttribute()
    {
        $light = (new DeconzApi())->getLight($this->networkId);
        return ($light ? $light->state->on : false);
    }
}
