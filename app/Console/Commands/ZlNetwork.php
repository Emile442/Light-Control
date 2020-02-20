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

    private function notNullAsk(string $ask)
    {
        $name = $this->ask($ask);
        if ($name != "") {
            return ($name);
        }
        return ($this->notNullAsk($ask));
    }

    private function displayNetwork()
    {
        $lights = Light::all();

        $deconz = new DeconzApi();
        $array = [];
        foreach ($lights as $key => $light) {
            $network = $deconz->getLight($light->networkId);
            $array[$key]['ID'] = $light->name;
            $array[$key]['name'] = $light->name;
            $array[$key]['state'] = $network->state->on ? "on" : "off";
        }

        $this->table(['ID', 'name', 'state'], $array);
    }

    private function changeLightState()
    {
        $id = $this->ask("Which light do you want to change ?");
        $state = $this->choice("State", ['on', 'off']);

        $deconz = (new DeconzApi())->setLightState($id, $state == "on" ? true : false);
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $mode = $this->choice('What do you want to do ?', [
//            'Display Network',
//        ]);

        //if ($mode == 'Display Network')
            //$this->displayNetwork();
        $this->changeLightState();
    }
}
