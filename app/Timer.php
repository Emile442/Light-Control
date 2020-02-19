<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    public $timestamps = false;
    protected $fillable = ['job_id', 'group_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function group()
    {
        return ($this->belongsTo(Group::class));
    }
}
