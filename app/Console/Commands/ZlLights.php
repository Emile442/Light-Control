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

    public function displayGroup()
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

    public function displayLight()
    {
        $lights = \App\Light::all(['id', 'name', 'networkId'])->toArray();
        $this->table(['id', 'name', 'networkId'], $lights);
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
        $mode = $this->choice('Que voulez vous faire ?', ['Ajouter une lumière', 'Supprimer une lumière', 'Lister les lumières']);

        if ($mode == 'Ajouter une lumière')
            $this->addLight();
        elseif ($mode == "Supprimer une lumière")
            $this->removeLight();
        elseif ($mode == "Lister les lumières")
            $this->displayLight();
    }
}
