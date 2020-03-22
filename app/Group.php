<?php

namespace App;

use App\Concern\Lightable;
use App\Concern\Switchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Switchable, Lightable;

    protected $fillable = ['name', 'public'];
    protected $appends = ['canSwitch'];

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'routine_group');
    }

    public function timers()
    {
        return $this->hasMany(Timer::class);
    }

}
