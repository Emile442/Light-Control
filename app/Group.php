<?php

namespace App;

use App\Concern\Switchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Switchable;

    protected $fillable = ['name', 'public'];

    public function lights()
    {
        return $this->hasMany(Light::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'routine_group');
    }

    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

    public function getCanSwitchAttribute()
    {
        $timer = $this->timers->first();

        if(!$timer)
            return true;
        if (Carbon::now()->addMinutes(10)->greaterThan(Carbon::createFromTimestamp($timer->job->available_at)))
            return true;
        return false;
    }
}
