<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $appends = ['created_t'];

    public function getCreatedTAttribute()
    {
        return $this->created_at->timestamp;
    }
}
