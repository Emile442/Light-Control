<?php

namespace App\Http\Controllers;

use App\Group;
use App\Jobs\GroupsStateJobs;
use App\Timer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function guest()
    {
        $groups = Group::with('timers')->where('public', true)->orderBy('name', 'asc')->get();
        return view('guest.index', compact('groups'));
    }

    public function groupSwitch($id)
    {
        $group = Group::find($id);
        if (!$group || !$group->public)
            abort(404);

        if (!$group->canSwitch)
            return redirect(route('guest'))->with('error', "Impossible réessayer 10min avant la fin du compte à rebourd");

        $group->switchDiffer(true, 30);

        return redirect(route('guest'))->with('success', "Lumières du groupe {$group->name} allumées");
    }
}
