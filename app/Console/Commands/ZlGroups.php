<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ZlGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zl:groups';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zigbee Lights - Groups';

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

    private function addGroup()
    {
        $name = $this->notNullAsk("Quel est le nom du Groupe ?");
        \App\Group::create(["name" => $name]);
        $this->line("Le groupe $name à bien été ajouté");
    }

    public function displayGroup()
    {
        $groups = \App\Group::all(['id', 'name'])->toArray();
        $this->table(['id', 'name'], $groups);
    }

    private function removeGroup()
    {
        $this->displayGroup();
        $id = $this->notNullAsk("Quel groupe voulez-vous supprimer ?");
        $group = \App\Group::find($id);
        if (is_null($group))
            $this->removeGroup();
        if ($this->confirm("Etes-vous sur de vouloir supprimer le groupe '" . $group->name . "'"))
            $group->delete();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->choice('Que voulez vous faire ?', ['Ajouter un groupe', 'Supprimer un groupe', 'Lister les groupes']);

        if ($mode == 'Ajouter un groupe')
            $this->addGroup();
        elseif ($mode == "Supprimer un groupe")
            $this->removeGroup();
        elseif ($mode == "Lister les groupes")
            $this->displayGroup();
    }
}
