<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    protected $fillable = ['name', 'networkId'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_light');
    }

}
