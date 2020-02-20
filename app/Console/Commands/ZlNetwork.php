<?php

namespace App\Console\Commands;

use App\Light;
use App\Zigbee\DeconzApi;
use Illuminate\Console\Command;

class ZlNetwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zl:network';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zigbee Lights - Network';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->changeLightState();
    }

    private function notNullAsk(string $ask)
    {
        $name = $this->ask($ask);
        if ($name != '')
            return $name;
        return $this->notNullAsk($ask);
    }

    private function changeLightState()
    {
        $id = $this->ask('Which light do you want to change ?');
        $state = $this->choice('State', ['on', 'off']);

        (new DeconzApi())->setLightState($id, $state == 'on' ? true : false);
    }

}
