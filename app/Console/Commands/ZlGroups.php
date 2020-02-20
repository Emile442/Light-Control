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
        $name = $this->notNullAsk("What is the name of the group ?");
        \App\Group::create(["name" => $name]);
        $this->line("Group $name added");
    }

    public function displayGroup()
    {
        $groups = \App\Group::all(['id', 'name'])->toArray();
        $this->table(['id', 'name'], $groups);
    }

    private function removeGroup()
    {
        $this->displayGroup();
        $id = $this->notNullAsk("Which group you want to delete ?");
        $group = \App\Group::find($id);
        if (is_null($group))
            $this->removeGroup();
        if ($this->confirm("Comfirm delete '" . $group->name . "'"))
            $group->delete();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mode = $this->choice('What do you want to do ?', ['Add group', 'Delete group', 'List groups']);

        if ($mode == 'Add group')
            $this->addGroup();
        elseif ($mode == "Delete group")
            $this->removeGroup();
        elseif ($mode == "List groups")
            $this->displayGroup();
    }
}
