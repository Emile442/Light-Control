<?php

namespace App\Concern;

use App\Group;
use App\Job;
use App\Jobs\GroupsStateJobs;
use App\Timer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait Switchable
{
    public function switchDiffer($state, $period)
    {
        $group = Group::find($this->id);
        $timer = Timer::where('group_id', $this->id)->first();
        if ($timer)
            $timer->job->delete();

        $delay = Carbon::now()->addMinutes($period);

        GroupsStateJobs::dispatch($group, $state);
        GroupsStateJobs::dispatch($group, !$state)->delay($delay);

        $job = Job::where('available_at', $delay->timestamp)->first();
        Timer::create(['group_id' => $this->id, 'job_id' => $job->id]);
    }

    public function getCanSwitchAttribute()
    {
        if (Auth::user()->suspend)
            return false;
        $now = Carbon::now()->format('H');
        // $now = 22;
        if (($now >= env('DAY_HOUR', 8)) && ($now < env('NIGHT_HOUR', 20)))
            return false;

        $timer = $this->timers->first();
        if(!$timer)
            return true;

        if (Carbon::now()->addMinutes(10)->greaterThan(Carbon::createFromTimestamp($timer->job->available_at)))
            return true;
        return false;
    }
}
