<?php

namespace App\Concern;

use App\Job;
use App\Jobs\GroupsStateJobs;
use App\Timer;
use Carbon\Carbon;

trait Switchable {

    public function switchDiffer($state, $period)
    {
        $timer = Timer::where('group_id', $this->id)->first();
        if ($timer)
            $timer->job->delete();

        $delay = Carbon::now()->addMinutes($period);

        GroupsStateJobs::dispatch($this, $state);
        GroupsStateJobs::dispatch($this, !$state)->delay($delay);

        $job = Job::where('available_at', $delay->timestamp)->first();
        Timer::create(['group_id' => $this->id, 'job_id' => $job->id]);
    }

}
