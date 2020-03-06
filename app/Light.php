<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $fillable = ['name', 'networkId'];
    protected $appends = ['state', 'loader'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_light');
    }

    public function getStateAttribute()
    {
        return null;
    }

    public function getLoaderAttribute()
    {
        return true;
    }

}
