<?php

namespace App\Jobs;

use App\Group;
use App\Zigbee\DeconzApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GroupsStateJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Group
     */
    private $group;
    /**
     * @var bool
     */
    private $state;

    /**
     * Create a new job instance.
     *
     * @param Group $group
     * @param bool $state
     */
    public function __construct(Group $group, bool $state)
    {
        $this->group = $group;
        $this->state = $state;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $deconz = new DeconzApi();

        $lights = [];
        foreach ($this->group->lights as $light)
            $lights[] = $light->networkId;

        $deconz->setLightsState($lights, $this->state);
    }
}
