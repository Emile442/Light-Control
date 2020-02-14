<?php

namespace App\Console\Commands;

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

    private function notNullAsk(string $ask)
    {
        $name = $this->ask($ask);
        if ($name != "") {
            return ($name);
        }
        return ($this->notNullAsk($ask));
    }

    private function displayGroup()
    {
        $groups = \App\Group::all(['id', 'name'])->toArray();
        $this->table(['id', 'name'], $groups);
    }

    private function addLight()
    {
        $name = $this->notNullAsk("Quel est le nom de la lumière ?");

        $this->displayGroup();
        $groupId = $this->notNullAsk("Quel est le groupe de la lumière ?");

        $networkId = $this->notNullAsk("Quel est l'ID de la lumière ?");

        \App\Light::create(["name" => $name, "group_id" => $groupId, "networkId" => $networkId]);
        $this->line("La lumière $name à bien été ajouté");
    }

    private function displayLight()
    {
        $lights = \App\Light::all(['id', 'name', 'group_id', 'networkId'])->toArray();
        $this->table(['id', 'name', 'groupId', 'networkId'], $lights);
    }

    private function removeLight()
    {
        $this->displayLight();
        $id = $this->notNullAsk("Quel groupe voulez-vous supprimer ?");
        $light = \App\Light::find($id);
        if (is_null($light))
            $this->removeLight();
        if ($this->confirm("Etes-vous sur de vouloir supprimer la lumière '" . $light->name . "'"))
            $light->delete();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->choice('What do you to do ?', [
            'Add Light',
            'Del Light',
            'List Lights',
        ]);

        if ($mode == 'Add Light')
            $this->addLight();
        elseif ($mode == "Del Light")
            $this->removeLight();
        elseif ($mode == "List Lights")
            $this->displayLight();
    }
}
