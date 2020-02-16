<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use App\Jobs\GroupsStateJobs;
use App\Zigbee\DeconzApi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function setGroupState($id, $state)
    {
        $group = Group::find($id);
        if (!$group)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Group not Found'
                ]
            ]);

        $r = new DeconzApi();
        $errors = [];
        foreach ($group->lights as $light) {
            $e = $r->setLightState($light->networkId, $state);
            if (is_null($e))
                $errors[] = "[{$light->name}][#{$light->networkId}] Unable to connect the light";
        }
        return response()->json([
            'success' => empty($errors) ? true : false,
            'state' => $state,
            'errors' => $errors
        ]);
    }

    public function setGroupStateForXMinutes($id, $state, $period)
    {
        $group = Group::find($id);
        if (!$group)
            return response()->json([
                'success' => false,
                'errors' => [
                    'Group not Found'
                ]
            ]);

        $this->dispatch(new GroupsStateJobs($group, $state));
        $this->dispatch((new GroupsStateJobs($group, !$state))->delay(Carbon::now()->addMinutes($period)));

        return response()->json([
            'success' => true,
            'errors' => []
        ]);
    }
}
