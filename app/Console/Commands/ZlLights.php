<?php

namespace App\Console\Commands;

use App\Light;
use Illuminate\Console\Command;

class ZlLights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zl:lights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zigbee Lights - Lights';

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
        $mode = $this->choice('What do you want to do ?', [
            'Add Light',
            'Delete Light',
            'List Lights',
        ]);

        if ($mode == 'Add Light')
            $this->addLight();
        elseif ($mode == 'Delete Light')
            $this->removeLight();
        elseif ($mode == 'List Lights')
            $this->displayLight();
    }

    private function notNullAsk(string $ask)
    {
        $name = $this->ask($ask);
        if ($name != '')
            return $name;
        return $this->notNullAsk($ask);
    }

    private function displayGroup()
    {
        $groups = \App\Group::all(['id', 'name'])->toArray();
        $this->table(['id', 'name'], $groups);
    }

    private function addLight()
    {
        $name = $this->notNullAsk('What is the name of the light ?');

        $this->displayGroup();
        $groupId = $this->notNullAsk('To which group does the light belongs ?');

        $networkId = $this->notNullAsk('What is the ID of the light ?');

        Light::create(['name' => $name, 'group_id' => $groupId, 'networkId' => $networkId]);
        $this->line("Light {$name} added");
    }

    private function displayLight()
    {
        $lights = Light::all(['id', 'name', 'group_id', 'networkId'])->toArray();
        $this->table(['id', 'name', 'groupId', 'networkId'], $lights);
    }

    private function removeLight()
    {
        $this->displayLight();
        $id = $this->notNullAsk('Which light you want to delete ?');
        $light = Light::find($id);
        if (is_null($light))
            $this->removeLight();
        if ($this->confirm("Confirm delete '{$light->name}'"))
            $light->delete();
    }
}
